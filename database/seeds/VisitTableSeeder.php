<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Flat;
use App\Visit;

class VisitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // assegniamo visite random a tutti i flats
        // richiamo tutti i flats
        $flats = Flat::all();

        // mesi totali da riempire
        $totalMonth = Carbon::now()->month;

        // cicliamo ogni mese
        for ($j=1; $j <= $totalMonth; $j++) { 
            // ciclio tutti i flats
            foreach ($flats as $flat) {
                // per ogni flat assegno dai 30 alle 40 visite
                $e = random_int(30, 40);
                for ($i=0; $i < $e; $i++) { 
                    $newVisit = new Visit;
                    $newVisit->ip_address = $faker->ipv4();
    
                    // prendi l'anno attuale
                    $year = Carbon::now()->year;
    
                    // prendi il mese del loop attuale
                    $month = $j;
                    if (strlen($month) == 1) {
                        $month = '0' . $month;
                    }
    
                    // prendi un giorno tra un range definito
                    $day = random_int(1, 28);
    
                    $newVisit->created_at = $year . '-' . $month . '-' . $day . ' 12:00:00';
                    $newVisit->updated_at = $year . '-' . $month . '-' . $day . ' 12:00:00';
                    $flat->visits()->save($newVisit);
                }
            }
        }
    }
}
