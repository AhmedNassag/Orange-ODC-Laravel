<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create
        ([
            'name'     => 'Ahmed Nabil',
            'email'    => 'ahmednassag@gmail.com',
            'password' => bcrypt('0101685643320111993'),
            'image'    => '1.jpg',
        ]);
    }
}
