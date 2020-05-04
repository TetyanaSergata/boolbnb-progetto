<?php

use Illuminate\Database\Seeder;
use App\Flat_address;
use Faker\Generator as Faker;

class FlatAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 20 indirizzi totali
        $addresses = [
            [
                'Roma',
                'Via Plinio',
                '23',
                '00193'
            ],
            [
                'Roma',
                'Via Cola di Rienzo',
                '140',
                '00193'
            ],
            [
                'Roma',
                'Via Nicola Ricciotti',
                '6',
                '00195'
            ],
            [
                'Roma',
                'Via Costabella',
                '24',
                '00195'
            ],
            [
                'Napoli',
                'Via Felice Cavallotti',
                '38',
                '80141'
            ],
            [
                'Napoli',
                'Via Pietro Giannone',
                '5',
                '80141'
            ],
            [
                'Napoli',
                'Via Piazzolla',
                '68',
                '80141'
            ],
            [
                'Napoli',
                'Via De Marco Carlo',
                '24',
                '80137'
            ],
            [
                'Napoli',
                'Via Antonio Ciccone',
                '12',
                '80133'
            ],
            [
                'Napoli',
                'Via Bartolomeo Chioccarelli',
                '1',
                '80133'
            ],
            [
                'Rimini',
                'Viale Cirenaica',
                '8',
                '47921'
            ],
            [
                'Rimini',
                'Viale Derna',
                '11',
                '47921'
            ],
            [
                'Rimini',
                'Viale Dandolo',
                '17',
                '47921'
            ],
            [
                'Rimini',
                'Viale Colombo',
                '6',
                '47921'
            ],
            [
                'Rimini',
                'Via Teofilo Folengo',
                '1',
                '47921'
            ],
            [
                'Milano',
                'Via Borgospesso',
                '9',
                '20121'
            ],
            [
                'Milano',
                'Vicolo Giardino',
                '22',
                '20121'
            ],
            [
                'Milano',
                'Via Romagnosi',
                '6',
                '20121'
            ],
            [
                'Milano',
                'Via Clerici',
                '2',
                '20121'
            ],
            [
                'Cesena',
                'Via Cheren',
                '74',
                '47522'
            ]
        ];

        $j = 1;
        foreach ($addresses as $address) {
            $newAddress = new Flat_address;
            $newAddress->flat_id = $j;
            $newAddress->city = $address[0];
            $newAddress->street = $address[1];
            $newAddress->street_number = $address[2];
            $newAddress->zip_code = $address[3];
            $newAddress->save();
            $j = $j + 1;
        }
    }
}
