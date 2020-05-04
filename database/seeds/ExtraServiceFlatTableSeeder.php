<?php

use Illuminate\Database\Seeder;
use App\Flat;

class ExtraServiceFlatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // appartamenti del primo utente
        $flats = Flat::where('user_id', '=', '1')->get();
        foreach ($flats as $flat) {
            $flat->extra_service()->attach([random_int(1,2), random_int(3,4), random_int(5,6)]);
        }

        // appartamenti del secondo utente
        $flats = Flat::where('user_id', '=', '2')->get();
        foreach ($flats as $flat) {
            $flat->extra_service()->attach([random_int(1,2), random_int(5,6)]);
        }

        // appartamenti del terzo utente
        $flats = Flat::where('user_id', '=', '3')->get();
        foreach ($flats as $flat) {
            $flat->extra_service()->attach([random_int(1,6)]);
        }

        // appartamenti del quarto utente
        $flats = Flat::where('user_id', '=', '4')->get();
        foreach ($flats as $flat) {
            $flat->extra_service()->attach([random_int(1,2), random_int(3,4), random_int(5,6)]);
        }

        // appartamenti del quinto utente
        $flats = Flat::where('user_id', '=', '5')->get();
        foreach ($flats as $flat) {
            $flat->extra_service()->attach([random_int(1,2), random_int(3,4)]);
        }
    }
}
