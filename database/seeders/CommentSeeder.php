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
            'user_id' => 1,
            'record_id' => 1,
            'comment' => '45手目に角交換はどうでしょう',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
