<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Tama',
            'email' => 'customer1@sample.com',
            'password' => bcrypt('yokotadayo'),
            'created_at' => '2023-11-05 11:11:01',
            'updated_at' => '2023-11-05 11:11:01'
        ]);
        Customer::create([
            'name' => 'Pochi',
            'email' => 'customer2@sample.com',
            'password' => bcrypt('yokotadayo'),
            'created_at' => '2023-11-05 11:12:01',
            'updated_at' => '2023-11-05 11:12:01'
        ]);
    }
}
