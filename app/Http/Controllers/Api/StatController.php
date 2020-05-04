<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Flat;
use App\Message;
use Carbon\Carbon;
use App\Visit;

class StatController extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $month = $data['month'];
        $flat = Flat::where('id', $id)->first();
        $visits = DB::table('visits')
        ->select('*')
        ->where('flat_id', $flat->id)
        ->orderby('visits.created_at', 'asc')
        ->get();

        $timestamps = [];
        foreach ($visits as $visit) {
            $day = new Carbon($visit->created_at);
            if ($month == null) {
                if ($day->isSameMonth(Carbon::now())) {
                    $timestamps[] = new Carbon($visit->created_at);
                }
            } else {
                $year = Carbon::now()->year;
                $monthCarbon = new Carbon($year . '-' . $month . '-1 12:00:00');
                if ($day->isSameMonth($monthCarbon)) {
                    $timestamps[] = new Carbon($visit->created_at);
                }
            }
        }

        // numero di girni totali del mese attuale
        if ($month == null) {
            $days = Carbon::now()->daysInMonth;
        } else {
            $days = $monthCarbon->daysInMonth;
        }

        // array con dati finali
        $stats = [];
        // cicliamo ogni singolo giorno del mese
        for ($i=1; $i <= $days; $i++) {
            $j = 0;
            // cicliamo le date nella tabella visits del db
            foreach ($timestamps as $key => $timestamp) {
                // controlliamo che il giorno attuale $i e' uguale al giorno del timestamp
                if ($timestamp->day == $i) {
                    $j =  $j + 1;
                    $stats[$i] = $j;
                } else {
                    $stats[$i] = $j;
                }
            }
        }

        $statsNew = array_values($stats);

        $daysArray = [];
        for ($i=1; $i <= $days ; $i++) { 
            $daysArray[] = $i;
        }

        // calcolo visite totali
        $total = 0;
        foreach ($statsNew as $key => $statNew) {
            $total = $total + $statNew;
        }

        $result = [
            'stats'=> $statsNew,
            'days' => $daysArray,
            'total' => $total
        ];

        return response()->json($result, 200);
    }

    public function message(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $month = $data['month'];
        $flat = Flat::where('id', $id)->first();
        $messages = DB::table('messages')
        ->select('*')
        ->where('flat_id', $flat->id)
        ->orderby('messages.created_at', 'asc')
        ->get();

        $timestamps = [];
        foreach ($messages as $message) {
            $day = new Carbon($message->created_at);
            if ($month == null) {
                if ($day->isSameMonth(Carbon::now())) {
                    $timestamps[] = new Carbon($message->created_at);
                }
            } else {
                $year = Carbon::now()->year;
                $monthCarbon = new Carbon($year . '-' . $month . '-1 12:00:00');
                if ($day->isSameMonth($monthCarbon)) {
                    $timestamps[] = new Carbon($message->created_at);
                }
            }
        }

        // numero di girni totali del mese attuale
        if ($month == null) {
            $days = Carbon::now()->daysInMonth;
        } else {
            $days = $monthCarbon->daysInMonth;
        }

        // array con dati finali
        $stats = [];
        // cicliamo ogni singolo giorno del mese
        for ($i=1; $i <= $days; $i++) {
            $j = 0;
            // cicliamo le date nella tabella messages del db
            foreach ($timestamps as $key => $timestamp) {
                // controlliamo che il giorno attuale $i e' uguale al giorno del timestamp
                if ($timestamp->day == $i) {
                    $j =  $j + 1;
                    $stats[$i] = $j;
                } else {
                    $stats[$i] = $j;
                }
            }
        }

        $statsNew = array_values($stats);

        $daysArray = [];
        for ($i=1; $i <= $days ; $i++) { 
            $daysArray[] = $i;
        }
        // calcolo messaggi totali
        $total = 0;
        foreach ($statsNew as $key => $statNew) {
            $total = $total + $statNew;
        }

        $result = [
            'stats'=> $statsNew,
            'days' => $daysArray,
            'total' => $total
        ];
        return response()->json($result, 200);
    }
}
