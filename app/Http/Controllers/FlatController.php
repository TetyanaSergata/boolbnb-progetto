<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Flat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Promo_service;
use App\Extra_service;
use Carbon\Carbon;
use App\Visit;

class FlatController extends Controller
{
    public function index()
    {
      // chiamamo tutti i flat dal db
      // prendi solo quelli con la promo e end maggiore di now
      $now = Carbon::now();
      $flatsPromo = DB::table("flats")
      ->select("*")
      ->join('flat_promo_service', 'flats.id', '=', 'flat_promo_service.flat_id')
      ->join('promo_services', 'flat_promo_service.promo_service_id', '=', 'promo_services.id')
      ->where('end', '>', $now)
      ->where('hidden', '=', 0)
      ->get();

      $flats = [];
      $array = [];
      
      $flat = DB::table("flats")
       ->select("*", 'flats.id AS code')
       ->leftJoin('flat_promo_service', 'flats.id', '=', 'flat_promo_service.flat_id')
       ->leftJoin('promo_services', 'flat_promo_service.promo_service_id', '=', 'promo_services.id')
       ->where('promo_service_id', '=', null)
       ->where('hidden', '=', 0)
       ->get();
    
      for ($i=0; $i < count($flat); $i++) { 
        $array[$i] = $flat[$i];
      }
      shuffle($array);
      for ($i=0; $i < 6; $i++) { 
        $flats[$i] = $array[$i]; 
      }
      
      return view ('my-home', compact('flats','flatsPromo'));
    }

    public function show($slug)
    {
      $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
      $promos = Promo_service::all();
      $flats = Flat::where('slug', $slug)->first();

      if(empty($flats)){
        abort(404);
      }
      $lastVisit = DB::table('visits')
        ->select('*')
        ->where('flat_id', $flats->id)
        ->orderby('visits.id', 'desc')
        ->first();
        if(!isset($lastVisit->created_at)){
          $newVisit = new Visit;
          $newVisit->ip_address = $ip;
          $newVisit->flat_id = $flats->id;
          $saved = $newVisit->save();
        } else {
          $myDate = new Carbon($lastVisit->created_at);
          $control = new Carbon($lastVisit->created_at);
          $control = $control->addHour(1);
          if (!Carbon::now()->lessThan($control)) {
            $newVisit = new Visit;
            $newVisit->ip_address = $ip;
            $newVisit->flat_id = $flats->id;
            $saved = $newVisit->save();
          }
        }
      

      $extras = DB::table("flats")
      ->select("*")
      ->join('extra_service_flat', 'flats.id', '=', 'extra_service_flat.flat_id')
      ->join('extra_services', 'extra_service_flat.extra_service_id', '=', 'extra_services.id')
      ->get();
       
      

      return view('show', compact('flats', 'promos', 'extras'));
    }
}

