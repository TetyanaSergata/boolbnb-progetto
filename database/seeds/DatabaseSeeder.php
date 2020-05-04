<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        // $this->call(UserInfosTableSeeder::class);
        $this->call(FlatsTableSeeder::class);
        // $this->call(ImagesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ExtraServicesTableSeeder::class);
        $this->call(PromoServicesTableSeeder::class);
        $this->call(FlatAddressesTableSeeder::class);
        $this->call(ExtraServiceFlatTableSeeder::class);
        $this->call(FlatPromoServiceTableSeeder::class);
        $this->call(VisitTableSeeder::class);
    }
}
