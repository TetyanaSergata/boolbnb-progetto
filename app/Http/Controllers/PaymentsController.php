<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo_service;
use App\Flat;

class PaymentsController extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $promo = Promo_service::all()->where('price', $data['price'])->first();
        $price = $promo->price;
        $flat_id = $data['flat_id'];
        return view('user.payment', compact('flat_id', 'price'), ['promo'=>$promo]);
    }

     public function make(Request $request,$price)
    {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $status = \Braintree\Transaction::sale([
                                'amount' => $price,
                                'paymentMethodNonce' => $nonce,
                                'options' => [
                                        'submitForSettlement' => True
                                            ]
                ]);
        return response()->json($status);
    }
}
