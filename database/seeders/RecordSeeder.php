<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('records')->insert([
            'user_id' => 1,
            'title' => 'サンプル1',
            'first_player_name' => 'Karuaru',
            'second_player_name' => 'opponent',
            'first_player_strategy' => '対振り持久戦',
            'second_player_strategy' => '四間飛車',
            'first_player_castle' => '居飛車穴熊',
            'second_player_castle' => '高美濃囲い',
            'record' => 
            '1 ７六歩(77)   (00:02/00:00:02)
            2 ３四歩(33)   (00:01/00:00:01)
            3 ２六歩(27)   (00:01/00:00:03)',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
