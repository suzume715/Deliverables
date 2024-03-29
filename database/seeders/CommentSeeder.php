<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'user_id' => 2,
            'record_id' => 1,
            'comment' => '結果的には6九角が悪手でしたか',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        DB::table('comments')->insert([
            'user_id' => 4,
            'record_id' => 1,
            'comment' => 'やはり同じAI同士では先手必勝なのでしょうか',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
