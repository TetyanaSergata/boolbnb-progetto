<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Flat;

class MapController extends Controller
{
    public function index(Request $request) {
        $data = $request->all();
        $flat = Flat::where('id', $data['id'])->first();
        $lat = $flat->lat;
        $long = $flat->long;
        $fullAddress = $flat->flat_address->street . ' ' . $flat->flat_address->street_number . ' ' . $flat->flat_address->city . ' ' . $flat->flat_address->zip_code;
        $result = [
            'lat' => $lat,
            'long' => $long,
            'fullAddress' => $fullAddress
        ];
        return response()->json($result, 200);
      }

    public function create(Request $request) {
        
    }
}
