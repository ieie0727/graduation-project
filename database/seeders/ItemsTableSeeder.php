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
            'price' => 1500,
            'detail' => '',
            'image_name' => '',
            'last_updated_by' => '1'
        ]);

        DB::table('items')->insert([
            'name' => 'Super Market Fantasy',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1000,
            'detail' => '',
            'image_name' => '',
            'last_updated_by' => '1'
        ]);

        // 勝手にシンドバッド
        DB::table('items')->insert([
            'name' => '勝手にシンドバッド',
            'artist' => 'サザンオールスターズ',
            'category' => 'J-POP',
            'price' => 1500,
            'detail' => 'サザンオールスターズの代表曲の一つ。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        // TSUNAMI
        DB::table('items')->insert([
            'name' => 'TSUNAMI',
            'artist' => 'サザンオールスターズ',
            'category' => 'J-POP',
            'price' => 1200,
            'detail' => 'サザンオールスターズのヒット曲。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        // 米津玄師
        DB::table('items')->insert([
            'name' => 'Lemon',
            'artist' => '米津玄師',
            'category' => 'J-POP',
            'price' => 1800,
            'detail' => '米津玄師のヒット曲「Lemon」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => '馬と鹿',
            'artist' => '米津玄師',
            'category' => 'J-POP',
            'price' => 2000,
            'detail' => '米津玄師の楽曲「馬と鹿」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        // official髭男dism
        DB::table('items')->insert([
            'name' => 'Pretender',
            'artist' => 'official髭男dism',
            'category' => 'J-POP',
            'price' => 1600,
            'detail' => 'official髭男dismの代表曲「Pretender」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => '宿命',
            'artist' => 'official髭男dism',
            'category' => 'J-POP',
            'price' => 2200,
            'detail' => 'official髭男dismの楽曲「宿命」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        // 乃木坂46
        DB::table('items')->insert([
            'name' => 'Influencer',
            'artist' => '乃木坂46',
            'category' => 'J-POP',
            'price' => 1500,
            'detail' => '乃木坂46の楽曲「Influencer」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'Sing Out!',
            'artist' => '乃木坂46',
            'category' => 'J-POP',
            'price' => 1900,
            'detail' => '乃木坂46の楽曲「Sing Out!」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        // Mr.Children
        DB::table('items')->insert([
            'name' => 'Tomorrow never knows',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1700,
            'detail' => 'Mr.Childrenの楽曲「Tomorrow never knows」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => '未完',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1900,
            'detail' => 'Mr.Childrenの楽曲「未完」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'Sign',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 2000,
            'detail' => 'Mr.Childrenの楽曲「Sign」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'HERO',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1800,
            'detail' => 'Mr.Childrenの楽曲「HERO」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => '花 -Mémento-Mori-',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 2100,
            'detail' => 'Mr.Childrenの楽曲「花 -Mémento-Mori-」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'Starting Over',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 2200,
            'detail' => 'Mr.Childrenの楽曲「Starting Over」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => '終わりなき旅',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1600,
            'detail' => 'Mr.Childrenの楽曲「終わりなき旅」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => '遥か',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1800,
            'detail' => 'Mr.Childrenの楽曲「遥か」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'CANDY',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 2000,
            'detail' => 'Mr.Childrenの楽曲「CANDY」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'Tomorrow never knows',
            'artist' => 'Mr.Children',
            'category' => 'J-POP',
            'price' => 1700,
            'detail' => 'Mr.Childrenの楽曲「Tomorrow never knows」。',
            'image_name' => '',
            'last_updated_by' => '1',
        ]);
    }
}
