<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            'name' => 'I?U',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'detail' => '',
            'image_name' => '',
            'last_updated_by' => '1'
        ]);

        DB::table('items')->insert([
            'name' => 'Super Market Fantasy',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'detail' => '',
            'image_name' => '',
            'last_updated_by' => '1'
        ]);
    }
}
