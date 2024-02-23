<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => '横田 裕明',
            'email' => 'yokota22h@yahoo.co.jp',
            'password' => bcrypt('yokotadayo'),
            'created_at' => '2023-11-05 11:01:01',
            'updated_at' => '2023-11-05 11:01:01'
        ]);
    }
}
