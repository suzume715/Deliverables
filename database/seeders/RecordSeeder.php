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
        
        DB::table('records')->insert([
            'user_id' => 1,
            'title' => 'サンプル2',
            'first_player_name' => 'Karuaru',
            'second_player_name' => 'opponent',
            'first_player_strategy' => '居飛車',
            'second_player_strategy' => '振り飛車',
            'first_player_castle' => '天野矢倉',
            'second_player_castle' => '居玉',
            'record' => 
            '1 ７六歩(77)   (00:01/00:00:01)
   2 ３四歩(33)   (00:01/00:00:01)
   3 ２六歩(27)   (00:00/00:00:01)
*▲備考：居飛車
   4 ４四歩(43)   (00:01/00:00:02)
   5 ２五歩(26)   (00:01/00:00:02)
   6 ３三角(22)   (00:01/00:00:03)
   7 ４八銀(39)   (00:01/00:00:03)
   8 ３二金(41)   (00:01/00:00:04)
   9 ５六歩(57)   (00:04/00:00:07)
  10 ４二銀(31)   (00:02/00:00:06)
',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
