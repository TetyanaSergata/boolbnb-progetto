<?php

use Illuminate\Database\Seeder;
use App\Flat;
use Carbon\Carbon;

class FlatPromoServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // promo per un appartamento del primo utente
        $flat = Flat::where('user_id', '=', '1')->first();
        $date = Carbon::now()->addHour(24);
        $flat->promo_service()->attach('1', ['end' => $date]);

        // promo per un appartamento del secondo utente
        $flat = Flat::where('user_id', '=', '2')->first();
        $date = Carbon::now()->addHour(72);
        $flat->promo_service()->attach('2', ['end' => $date]);

        // promo per un appartamento del terzo utente
        $flat = Flat::where('user_id', '=', '3')->first();
        $date = Carbon::now()->addHour(144);
        $flat->promo_service()->attach('3', ['end' => $date]);

        // promo per un appartamento del quarto utente
        $flat = Flat::where('user_id', '=', '4')->first();
        $date = Carbon::now()->addHour(24);
        $flat->promo_service()->attach('1', ['end' => $date]);
    }
}
