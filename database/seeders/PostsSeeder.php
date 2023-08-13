<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            try {
                \App\Models\Posts::factory()
                    ->count(1)
                    ->create();
            }catch (\Exception $exception){
//                $this->command->error("Error: " . $exception->getMessage());
                Log::error($exception->getMessage());
            }
        }
    }
}
