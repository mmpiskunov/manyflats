<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Admin',
                'email'             => 'admin@manyflats.com',
                'email_verified_at' => Carbon::now(),
                'active'            => true,
                'staff'             => true,
                'language'          => 'ru',
                'password'          => Hash::make('Ad3m43P12MiN'),
                'remember_token'    => Str::random(10)
            ]
        ];
        DB::table('users')->insert($users);

        //factory(User::class, 10)->create();
    }
}
