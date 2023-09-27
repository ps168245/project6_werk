<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KuinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorizationToken = 'Bearer 25|Iwe5b4MpgFMcNjQtWWzfUXzSnb41sfZdl7FE0O8C';

        $products = Http::withHeaders([
            'Authorization' => $authorizationToken,
        ])->withoutVerifying()->get('https://kuin.summaict.nl/api/product');

        return view('kuin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Plaats een orderline bij kuin
     */
    public function store(Request $request)
    {
        $authorizationToken = 'Bearer 25|Iwe5b4MpgFMcNjQtWWzfUXzSnb41sfZdl7FE0O8C';

        $orderline = Http::withHeaders([
            'Authorization' => $authorizationToken,
        ])->withoutVerifying()->post('https://kuin.summaict.nl/api/orderItem?product_id='.$request->product_id.'&quantity='.$request->quantity);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $authorizationToken = 'Bearer 25|Iwe5b4MpgFMcNjQtWWzfUXzSnb41sfZdl7FE0O8C';

        $product = Http::withHeaders([
            'Authorization' => $authorizationToken,
        ])->withoutVerifying()->get('https://kuin.summaict.nl/api/product/'.$id);

        return view('kuin.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function buttons()
    {
        return view('kuin.buttons');
    }

    public function orders()
    {
        $authorizationToken = 'Bearer 25|Iwe5b4MpgFMcNjQtWWzfUXzSnb41sfZdl7FE0O8C';

        $orders = Http::withHeaders([
            'Authorization' => $authorizationToken,
        ])->withoutVerifying()->get('https://kuin.summaict.nl/api/order');

        return view('kuin.orders', compact('orders'));
    }

    public function showOrder(string $id)
    {
        $authorizationToken = 'Bearer 25|Iwe5b4MpgFMcNjQtWWzfUXzSnb41sfZdl7FE0O8C';

        $order = Http::withHeaders([
            'Authorization' => $authorizationToken,
        ])->withoutVerifying()->get('https://kuin.summaict.nl/api/order/'.$id);

        $orderitems = Http::withHeaders([
            'Authorization' => $authorizationToken,
        ])->withoutVerifying()->get('https://kuin.summaict.nl/api/orderItem?order_id='.$id);

        return view('kuin.showOrder', compact('order'), compact('orderitems'));
    }
}
