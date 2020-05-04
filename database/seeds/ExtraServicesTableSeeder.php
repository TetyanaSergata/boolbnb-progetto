<?php

use Illuminate\Database\Seeder;
use App\Extra_service;
use Faker\Generator as Faker;

class ExtraServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $serviceName = [
            'wifi',
            'smoking',
            'parking',
            'swimming_pool',
            'breakfast',
            'view'
        ];

        for ($i=0; $i <= count($serviceName) -1; $i++) { 
            $newService = new Extra_Service;
            $newService->name = $serviceName[$i];
            $newService->save();
            
        }
    }
}
