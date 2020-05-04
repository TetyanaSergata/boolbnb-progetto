<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Flat;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // assegniamo messaggi random a tutti i flats
        // richiamo tutti i flats
        $flats = Flat::all();

        // mesi totali da riempire
        $totalMonth = Carbon::now()->month;

        // cicliamo ogni mese
        for ($j=1; $j <= $totalMonth; $j++) { 
            // ciclio tutti i flats
            foreach ($flats as $flat) {
                // per ogni flat assegno dai 30 ai 40 messaggi
                $e = random_int(30, 40);
                for ($i=0; $i < $e; $i++) { 
                    $newMessage = new Message;
                    $newMessage->email = $faker->email();
                    $newMessage->title = $faker->word();
                    $newMessage->message = $faker->text(155);
    
                    // prendi l'anno attuale
                    $year = Carbon::now()->year;
    
                    // prendi il mese del loop attuale
                    $month = $j;
                    if (strlen($month) == 1) {
                        $month = '0' . $month;
                    }
    
                    // prendi un giorno tra un range definito
                    $day = random_int(1, 28);
    
                    $newMessage->created_at = $year . '-' . $month . '-' . $day . ' 12:00:00';
                    $newMessage->updated_at = $year . '-' . $month . '-' . $day . ' 12:00:00';
                    $flat->messages()->save($newMessage);
                }
            }
        }
    }
}
