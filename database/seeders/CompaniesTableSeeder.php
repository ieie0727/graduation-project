<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'ieie商店',
                'address' => '東京都清瀬市',
                'email' => 'you.inoue.727@gmail.com',
                'phone_number' => '123-456-7890',
                'last_transaction_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('companies')->insert($companies);
    }
}
