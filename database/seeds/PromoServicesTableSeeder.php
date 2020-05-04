<?php

use Illuminate\Database\Seeder;
use App\Promo_service;

class PromoServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [

            'Promo Bronze' =>[
              'Promo Bronze',
              '2.99',
              '24 h'
             ],
  
             'Promo Silver' =>[
               'Promo Silver',
               '5.99',
               '72 h'
              ],
  
              'Promo Gold' =>[
                'Promo Gold',
                '9.99',
                '144 h'
               ]
  
          ];

          foreach ($services as $key => $service) {
            $newService = new Promo_Service;
            $newService->type = $service[0];
            $newService->price = $service[1];
            $newService->time = $service[2];
            $newService->save();
          }
    }
}

