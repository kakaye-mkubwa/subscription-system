<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed 700000 users and in case of exception, print the error message and continue
        for ($i = 0; $i < 1000; $i++) {
            try {
                \App\Models\User::factory()
                    ->count(1)
                    ->create();
            }catch (\Exception $exception){
//                $this->command->error("Error: " . $exception->getMessage());
                Log::error($exception->getMessage());
            }
        }
    }
}
