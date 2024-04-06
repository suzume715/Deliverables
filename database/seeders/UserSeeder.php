<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ユーザー1',
            'email' => 'user1@sample.com',
            'password' => Hash::make('user1passuser1word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー2',
            'email' => 'user2@sample.com',
            'password' => Hash::make('user2passuser2word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー3',
            'email' => 'user3@sample.com',
            'password' => Hash::make('user3passuser3word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー4',
            'email' => 'user4@sample.com',
            'password' => Hash::make('user4passuser4word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー5',
            'email' => 'user5@sample.com',
            'password' => Hash::make('user5passuser5word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー6',
            'email' => 'user6@sample.com',
            'password' => Hash::make('user6passuser6word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー7',
            'email' => 'user7@sample.com',
            'password' => Hash::make('user7passuser7word'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ユーザー8',
            'email' => 'user8@sample.com',
            'password' => Hash::make('user8passuser8word'),
        ]);
    }
}
