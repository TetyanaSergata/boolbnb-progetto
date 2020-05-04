<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // for ($i=0; $i < 40; $i++) { 
        //     $newImage = new Image;
        //     $newImage->flat_id = rand(1, 20);
        //     $newImage->path_image = $faker->imageUrl(640, 480);
        //     $newImage->save();
        // }
    }
}
