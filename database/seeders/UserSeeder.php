<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('tasks')->insert([
                'title'=>Str::random(10),
                'description'=>Str::random(10),
                'due_date'=>date('Y-m-d H:i:s'),
                'is_completed'=>false,
                'user_id'=>User::inRandomOrder()->first()->id ?? 1,
            ]);
        }

    }
}
