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
            'cpf'        => '11122233344',
            'name'       => 'João',
            'phone'      => '3599999999',
            'birth'      => '1980-10-01',
            'gender'     => 'M',
            'email'      => 'jogao@sistema.com',
            'password'   => bcrypt('123456')
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
