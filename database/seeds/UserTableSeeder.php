<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 5 utenti totali
        $users = [
            [
                'Pippo',
                'pippo@gmail.com'
            ],
            [
                'Paperino',
                'paperino@gmail.com'
            ],
            [
                'Paperina',
                'paperina@gmail.com'
            ],
            [
                'Topolino',
                'topolino@gmail.com'
            ],
            [
                'Minnie',
                'minnie@gmail.com'
            ]
        ];

        foreach ($users as $user) {
            $newUser = new User;
            $newUser->name = $user[0];
            $newUser->email = $user[1];
            $newUser->password = Hash::make('password');
            $newUser->save();
        }
    }
}
