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
            'user_id' => 1,
            'comment_id' => 1,
            'reply' => '同桂ですかね…',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
