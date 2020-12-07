<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Maxmeio',
            'email' => 'maxmeio@maxmeio.com',
            'password' => bcrypt('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
