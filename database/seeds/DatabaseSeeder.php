<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf'        => '11122233366',
            'name'       => 'João',
            'phone'      => '3599999999',
            'birth'      => '1980-10-01',
            'gender'     => 'M',
            'email'      => 'joaozinho@sistema.com',
            'password'   => env('PASSWORD_HASH') ? bcrypt('123456') : '123456'
        ]);
    }
}
