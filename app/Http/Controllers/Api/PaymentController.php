<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promo_service;
use App\Flat;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $flat = Flat::where('id', $data['flat'])->first();
        if ($data['promo'] == 1) {
            $date = Carbon::now()->addHour(24);
        } else if ($data['promo'] == 2){
            $date = Carbon::now()->addHour(72);
        } else {
            $date = Carbon::now()->addHour(144);
        }
        
        $flat->promo_service()->detach();
        $result = $flat->promo_service()->attach($data['promo'],['end' => $date]);
        return response()->json($result);
    }
}
