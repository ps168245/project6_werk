<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ShoppingcartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shoppingcart.index');
    }

    /**
     * GeneratePDF.
     */
    public function generatePDF($id)
    {
        $order = Order::find($id);
        $products = [];

        foreach ($order->orderlines as $orderline) {
            $value[$orderline->id] = ['product_id' => $orderline->product_id, 'amount' => $orderline->amount_orderd, 'price' => $orderline->price];
            $products[] = $orderline->product;
        }

        $address = $order->address;
        $date = $order->created_at;
        $fileName = 'GV_'.$id.'.pdf';
        $amountOfProducts = count($value);
        $data = [
            'title' => 'Factuur Groene vingers',
            'date' => $date,
            'products' => $products,
            'orderlines' => $value,
            'amountProducts' => $amountOfProducts,
            'address' => $address,
            'totaal' => 0,
        ];
        $pdf = Pdf::loadView('shoppingcart.invoiceLayout', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download($fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function afronden(Request $request)
    {
        //check if cart empty return shoppingcart index
        if (empty(session()->get('cart'))) {
            return view('shoppingcart.index');
        }
        $userid = $request->user()->id;
        $address = Address::where('user_id', '=', $userid)->get();
        $addressLength = $address->count();

        return view('shoppingcart.afronden', [
            'user' => $request->user(),
            'address' => $address,
            'addressLength' => $addressLength,
        ]);
    }

    public function betalen(Request $request)
    {
        //If there is no default address return to shoppingcart index
        if ($request->user()->default_address == null) {
            return view('shoppingcart.index');
        }
        //Which bank: $request->bank
        $betaald = true;
        //Complete order
        $order = new Order;
        $order->address_id = $request->user()->default_address;
        $order->user_id = $request->user()->id;
        $order->save();
        foreach (session('cart') as $item) {
            $orderline = new Orderline;
            $orderline->order_id = $order->id;
            $orderline->product_id = $item[0]->id;
            $orderline->amount_orderd = $item[0]->amount;
            $orderline->price = $item[0]->price;
            $order->total += $item[0]->price * $item[0]->amount;
            $orderline->save();
        }
        $order->save();
        $mollie = new MollieController;
        $mollie->payment($order, $request);
    }

    public function payed($id)
    {
        $order = Order::find($id);
        $title = 'Betaling niet betaald';
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_GuFf26c8h8AD2pVsgU2Aym7q7ESuun');
        $payment = $mollie->payments->get($order->mollie_id);

        if ($payment->isPaid()) {
            $order->status = 'betaald';
            $order->save();
            $title = 'Betaling is geslaagd. Kijk bij je geschiedenis voor je order.';
        }
        session()->forget('cart');

        return view('gelukt', ['title' => $title]);
    }

    public function orderHistory(Request $request)
    {
        $orders = User::find($request->user()->id)->orders;
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_GuFf26c8h8AD2pVsgU2Aym7q7ESuun');
        $products = [];

        foreach ($orders as $order) {
            $payment = $mollie->payments->get($order->mollie_id);
            $order->status = $payment->status;
            if ($payment->getCheckoutUrl() != null) {
                $order->link = $payment->getCheckoutUrl();
            } else {
                $order->link = null;
            }
            foreach ($order->orderlines as $orderline) {
                $products[] = $orderline->product;
            }
        }

        return view('shoppingcart.history', [
            'orders' => $orders,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chosenProduct = Product::find($id);
        $request->validate([
            'amount' => ['required', 'int', 'min:1', 'max:'.$chosenProduct->stock, 'not_regex:/[^0-9]/'],
        ]);
        session()->get('cart')[$id][0]->amount = $request->amount;

        return redirect()->route('shoppingcart.index');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'not_regex:/[^0-9]/'],
        ]);
        $chosenProduct = Product::find($request->product_id);
        //check if there are any specials
        if ($chosenProduct->dag_aanbieding == true || $chosenProduct->week_aanbieding == true) {
            $chosenProduct->price = $chosenProduct->price - (($chosenProduct->percentage_aanbieding / 100) * $chosenProduct->price);
        }
        $request->validate([
            'amount' => ['required', 'int', 'min:1', 'max:'.$chosenProduct->stock, 'not_regex:/[^0-9]/'],
        ]);
        $chosenProduct['amount'] = $request->amount;
        //Make new cart when one doesn't exist
        if (session()->get('cart') == null) {
            session(['cart']);
        }
        //Product with ID already exists. Increase amount with existing and newly chosen amount
        if (! empty(session()->get('cart.'.$chosenProduct->id))) {
            $existingAmount = session()->get('cart')[$chosenProduct->id][0]->amount;
            $totalAmount = $request->amount + $existingAmount;
            if ($totalAmount > $chosenProduct->stock) {
                $totalAmount = $chosenProduct->stock;
            }
            $chosenProduct['amount'] = $totalAmount;
            session()->forget('cart.'.$chosenProduct->id);
            session()->push('cart.'.$chosenProduct->id, $chosenProduct);

            return redirect()->route('shoppingcart.index');
        }
        //Push onto cart a new product chosen
        session()->push('cart.'.$chosenProduct->id, $chosenProduct);

        return redirect()->route('shoppingcart.index');
    }

    public function emptyCart()
    {
        session()->forget('cart');

        return redirect()->route('shoppingcart.index');
    }

    public function removeFromCart($id)
    {
        session()->forget('cart.'.$id);

        return redirect()->route('shoppingcart.index');
    }
}
