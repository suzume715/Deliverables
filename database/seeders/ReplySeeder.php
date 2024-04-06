<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('replies')->insert([
            'user_id' => 3,
            'comment_id' => 1,
            'reply' => 'そうですね、ここで評価値が開きました。あまり悪い手には見えないですけどね。むしろいい手にも見えます。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        DB::table('replies')->insert([
            'user_id' => 1,
            'comment_id' => 1,
            'reply' => '6八角打の方が良かったようです。同金、同飛成、7七角打、5九龍、同角と進みます。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        DB::table('replies')->insert([
            'user_id' => 5,
            'comment_id' => 2,
            'reply' => '必勝とまでは言えないでしょうが有利ではありそうですね。ただ、この棋譜でも途中までは後手に少し振れていたのであまり関係ないのかもしれません。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
