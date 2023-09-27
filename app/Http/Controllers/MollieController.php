<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MollieController extends Controller
{
    public function __construct()
    {
    }

    public function payment(Order $order, Request $request)
    {
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_GuFf26c8h8AD2pVsgU2Aym7q7ESuun');

        $payment = $mollie->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => number_format((float) $order->total, 2, '.'),
            ],
            'description' => 'Order #'.$order->id,
            'redirectUrl' => URL::to('/payed/'.$order->id),
        ]);
        $order->mollie_id = $payment->id;
        $order->save();
        redirect()->to($payment->getCheckoutUrl())->send();
    }
}
