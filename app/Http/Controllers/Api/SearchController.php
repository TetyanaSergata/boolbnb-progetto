<?php

namespace App\Http\Controllers\Api;

use App\Flat;
use App\Flat_address;
use App\Extra_service;
use App\Promo_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dati inseriti nella ricerca
        $data = $request->all();
        $city = $data['city'];
        $lat = $data['lat'];
        $lng = $data['long'];
        $now = Carbon::now();
        // chiamata al db con calcolo radius di 20 km
        $db = DB::table('flats')->get();
        $flatsPromo = DB::table("flats")
            ->select("*"
            ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
            * cos(radians(flats.lat)) 
            * cos(radians(flats.long) - radians(" . $lng . ")) 
            + sin(radians(" .$lat. ")) 
            * sin(radians(flats.lat))) AS distance"))
            ->having("distance", "<=", 20)
            ->join('flat_addresses', 'flats.id', '=', 'flat_addresses.flat_id')
            ->where('flat_addresses.city', 'LIKE', '%'.$city.'%')
            ->where('hidden', '=', 0)
            ->join('flat_promo_service', 'flats.id', '=', 'flat_promo_service.flat_id')
            ->join('promo_services', 'flat_promo_service.promo_service_id', '=', 'promo_services.id')
            ->where('end', '>', $now)
            ->get();
         
        $flats = DB::table("flats")
            ->select("*"
            ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
            * cos(radians(flats.lat)) 
            * cos(radians(flats.long) - radians(" . $lng . ")) 
            + sin(radians(" .$lat. ")) 
            * sin(radians(flats.lat))) AS distance"))
            ->having("distance", "<=", 20)
            ->join('flat_addresses', 'flats.id', '=', 'flat_addresses.flat_id')
            ->where('flat_addresses.city', 'LIKE', '%'.$city.'%')
            ->where('hidden', '=', 0)
            ->leftJoin('flat_promo_service', 'flats.id', '=', 'flat_promo_service.flat_id')
            ->leftJoin('promo_services', 'flat_promo_service.promo_service_id', '=', 'promo_services.id')
            ->where('promo_service_id', '=', null)
            ->orWhere('end', '<=', $now)
            ->get();
        
        $result = [
            'flatsPromo' => $flatsPromo,
            'flats' => $flats
        ];
        return response()->json($result, 200);
    }


    public function advanced(Request $request)
    {
        // dati inseriti nella ricerca
        $data = $request->all();
        $lat = $data['lat'];
        $lng = $data['long'];
        $beds = $data['beds'];
        $rooms = $data['rooms'];
        $radius = $data['radius'];
        $wifi = $data['wifi'];
        $smoking = $data['smoking'];
        $parking = $data['parking'];
        $swimmingPool = $data['swimmingPool'];
        $breakfast = $data['breakfast'];
        $view = $data['view'];
        $now = Carbon::now();

        // chiamata al db con calcolo radius definito da utente e altri parametri
        $db = DB::table('flats')->get();
        $flats = DB::table("flats")
            ->select("*", 'flats.id AS code'
            ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
            * cos(radians(flats.lat)) 
            * cos(radians(flats.long) - radians(" . $lng . ")) 
            + sin(radians(" .$lat. ")) 
            * sin(radians(flats.lat))) AS distance"))
            ->having("distance", "<=", $radius)
            ->leftJoin('extra_service_flat', 'flats.id', '=', 'extra_service_flat.flat_id')
            ->leftJoin('extra_services', 'extra_service_flat.extra_service_id', '=', 'extra_services.id')
            ->join('flat_addresses', 'flats.id', '=', 'flat_addresses.flat_id')
            ->orderBy('code')
            ->leftJoin('flat_promo_service', 'flats.id', '=', 'flat_promo_service.flat_id')
            ->leftJoin('promo_services', 'flat_promo_service.promo_service_id', '=', 'promo_services.id')
            // caso con promozione mai attivata
            ->where('promo_service_id', '=', null)
            ->where(function ($db) use($beds){
                if($beds != null){
                    $db->where('flats.beds', '=', $beds);
                }
            })
            ->where(function ($db) use($rooms){
                if($rooms != null){
                    $db->where('flats.rooms', '=', $rooms);
                }
            })
            ->where('hidden', '=', 0)
            // caso con promozione scaduta
            ->orWhere('end', '<=', $now)
            ->where(function ($db) use($beds){
                if($beds != null){
                    $db->where('flats.beds', '=', $beds);
                }
            })
            ->where(function ($db) use($rooms){
                if($rooms != null){
                    $db->where('flats.rooms', '=', $rooms);
                }
            })
            ->where('hidden', '=', 0)
            ->get();

        // filtrare i flats sistemando i servizi extra
        // nuovo array per i flats con extra aggiornati
        $newFlats = [];
        // ciclare tutti i flats
        for ($i=0; $i < count($flats); $i++) {
            // controllare che ci sia un altro flat dopo nel array
            if (isset($flats[$i + 1])) {
                // controllare i flat che hanno lo stesso id
                if ($flats[$i]->code == $flats[$i+1]->code) {
                    // salva tutti i servizi extra di quello attuale aggiungendo quello del flat dopo
                    $servizi = $flats[$i]->name . ' ' . $flats[$i + 1]->name;
                    // aggiorna i servizi del flat dopo con la nuova stringa di extra
                    $flats[$i + 1]->name = $servizi;
                } else{
                    // salva il flat col nuovo extra nel nostro nuovo array
                    $newFlats[] = $flats[$i];
                }
            }
            // se e' l'ultimo flat aggiungi comunque al array
            if (($i + 1) == count($flats)) {
                $newFlats[] = $flats[$i];
            }
        }

        // controllo che hanno i servizi che l'utente richiede
        // ciclare i nuovi flats con extra aggiornati
        $arrayBest = [];
        foreach ($newFlats as $key => $newFlat) {
            // variabile di controllo generica
            $check = true;
            // divide la stringa dei nomi in singole parti dentro un array
            $extraFlat = (explode(' ', $newFlat->name));
            // controllo se il wifi e' stato richiesto da utente
            if ($wifi != null) {
                // ricerca del extra wifi nel flat
                if (!is_int(array_search('wifi', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo smoking e' stato richiesto da utente
            if ($smoking != null) {
                // ricerca del extra smoking nel flat
                if (!is_int(array_search('smoking', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo parking e' stato richiesto da utente
            if ($parking != null) {
                // ricerca del extra parking nel flat
                if (!is_int(array_search('parking', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo swimmingPool e' stato richiesto da utente
            if ($swimmingPool != null) {
                // ricerca del extra swimmingPool nel flat
                if (!is_int(array_search('swimming_pool', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo breakfast e' stato richiesto da utente
            if ($breakfast != null) {
                // ricerca del extra breakfast nel flat
                if (!is_int(array_search('breakfast', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo view e' stato richiesto da utente
            if ($view != null) {
                // ricerca del extra view nel flat
                if (!is_int(array_search('view', $extraFlat))) {
                    $check = false;
                }
            }
            // se il check e' positivo, aggiungi il flat a un nuovo array
            if ($check) {
                $arrayBest[] = $newFlats[$key];
            }
        }
        
        $flatsPromo = DB::table("flats")
            ->select("*"
            ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
            * cos(radians(flats.lat)) 
            * cos(radians(flats.long) - radians(" . $lng . ")) 
            + sin(radians(" .$lat. ")) 
            * sin(radians(flats.lat))) AS distance"))
            ->having("distance", "<=", $radius)
            ->leftJoin('extra_service_flat', 'flats.id', '=', 'extra_service_flat.flat_id')
            ->leftJoin('extra_services', 'extra_service_flat.extra_service_id', '=', 'extra_services.id')
            ->join('flat_addresses', 'flats.id', '=', 'flat_addresses.flat_id')
            ->join('flat_promo_service', 'flats.id', '=', 'flat_promo_service.flat_id')
            ->join('promo_services', 'flat_promo_service.promo_service_id', '=', 'promo_services.id')
            ->where('end', '>', $now)
            ->orderBy('flat_promo_service.flat_id')
            ->where(function ($db) use($beds){
                if($beds != null){
                    $db->where('flats.beds', '=', $beds);
                }
            })
            ->where(function ($db) use($rooms){
                if($rooms != null){
                    $db->where('flats.rooms', '=', $rooms);
                }
            })
            ->where('hidden', '=', 0)
            ->get();
            
        // filtrare i flats sistemando i servizi extra
        // nuovo array per i flats con extra aggiornati
        $newFlatsPromo = [];
        // ciclare tutti i flats
        for ($i=0; $i < count($flatsPromo); $i++) {
            // controllare che ci sia un altro flat dopo nel array
            if (isset($flatsPromo[$i + 1])) {
                // controllare i flat che hanno lo stesso id
                if ($flatsPromo[$i]->flat_id == $flatsPromo[$i+1]->flat_id) {
                    // salva tutti i servizi extra di quello attuale aggiungendo quello del flat dopo
                    $servizi = $flatsPromo[$i]->name . ' ' . $flatsPromo[$i + 1]->name;
                    // aggiorna i servizi del flat dopo con la nuova stringa di extra
                    $flatsPromo[$i + 1]->name = $servizi;
                } else{
                    // salva il flat col nuovo extra nel nostro nuovo array
                    $newFlatsPromo[] = $flatsPromo[$i];
                }
            }
            // se e' l'ultimo flat aggiungi comunque al array
            if (($i + 1) == count($flatsPromo)) {
                $newFlatsPromo[] = $flatsPromo[$i];
            }
        }

        // controllo che hanno i servizi che l'utente richiede
        // ciclare i nuovi flats con extra aggiornati
        $arrayBestPromo = [];
        foreach ($newFlatsPromo as $key => $newFlatPromo) {
            // variabile di controllo generica
            $check = true;
            // divide la stringa dei nomi in singole parti dentro un array
            $extraFlat = (explode(' ', $newFlatPromo->name));
            // controllo se il wifi e' stato richiesto da utente
            if ($wifi != null) {
                // ricerca del extra wifi nel flat
                if (!is_int(array_search('wifi', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo smoking e' stato richiesto da utente
            if ($smoking != null) {
                // ricerca del extra smoking nel flat
                if (!is_int(array_search('smoking', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo parking e' stato richiesto da utente
            if ($parking != null) {
                // ricerca del extra parking nel flat
                if (!is_int(array_search('parking', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo swimmingPool e' stato richiesto da utente
            if ($swimmingPool != null) {
                // ricerca del extra swimmingPool nel flat
                if (!is_int(array_search('swimming_pool', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo breakfast e' stato richiesto da utente
            if ($breakfast != null) {
                // ricerca del extra breakfast nel flat
                if (!is_int(array_search('breakfast', $extraFlat))) {
                    $check = false;
                }
            }
            // controllo se lo view e' stato richiesto da utente
            if ($view != null) {
                // ricerca del extra view nel flat
                if (!is_int(array_search('view', $extraFlat))) {
                    $check = false;
                }
            }
            // se il check e' positivo, aggiungi il flat a un nuovo array
            if ($check) {
                $arrayBestPromo[] = $newFlatsPromo[$key];
            }
        }
        
        // invio json come risultato di risposta
        $result = [
            'flats' => $arrayBest,
            'flatsPromo' => $arrayBestPromo
        ];
        return response()->json($result, 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
