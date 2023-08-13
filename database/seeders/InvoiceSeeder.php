<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed 1 million records and in case of errors log message and carry on
        for ($i = 0; $i < 1000; $i++) {
            try {
                \App\Models\Invoice::factory()
                    ->count(1)
                    ->create();
            } catch (\Exception $e) {
                Log::error($e->getMessage());
//                $this->command->error("Error: " . $e->getMessage());
            }
        }
    }
}
