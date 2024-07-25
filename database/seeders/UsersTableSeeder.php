<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('data/output.ndjson');
        $fileContents = File::get($filePath);
        $lines = explode("\n", trim($fileContents));

        foreach($lines as $line)
        {
            if(!empty($line))
            {
                $user=json_decode($line,true);
                DB::table('users')->insert([
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'password'=>Hash::make($user['password']),
                    'role'=>$user['role'],
                    'bdo'=>$user['bdo'],
                    'district'=>$user['district'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }
    }
}
