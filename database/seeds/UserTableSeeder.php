<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'Otávio',
            'email' => 'otavio_slz15@hotmail.com',
            'password' => bcrypt('97432865')
        ]);	
    }
}
