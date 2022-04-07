<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubAdmin;

class SubAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubAdmin::create
        ([
            'name'     => 'Marwa Ahmed',
            'email'    => 'marwaahmed@gmail.com',
            'password' => bcrypt('18199320111993'),
            'image'    => '1.jpg',
        ]);
    }
}
