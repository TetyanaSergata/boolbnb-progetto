<?php

use Illuminate\Database\Seeder;
use App\User_info;
use Faker\Generator as Faker;

class UserInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // for ($i=0; $i < 5; $i++) {
        //     $newUserInfo = new User_info;
        //     $newUserInfo->user_id = rand(1, 10);
        //     $newUserInfo->path_image = $faker->imageUrl(640, 480);
        //     $newUserInfo->phone_number = 3345678;
        //     $newUserInfo->gender = $faker->word();
        //     $newUserInfo->address = $faker->address();
        //     $newUserInfo->save();
        // }
    }
}
