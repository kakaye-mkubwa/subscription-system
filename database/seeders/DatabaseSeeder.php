<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserSubscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // seed users
        $this->command->info('Seeding users...');
        $startTime = microtime(true);
        $this->command->info('Start time: ' . $startTime . ' seconds.');
        $this->call(UserSeeder::class);
        $finishUsersSeedTime = microtime(true);
        $this->command->info('Users seeded in ' . ($finishUsersSeedTime - $startTime) . ' seconds.');

        // seed subscription websites
        $this->command->info('Seeding subscription websites...');
        $startTime = microtime(true);
        $this->command->info('Start time: ' . $startTime . ' seconds.');
        $this->call(SubscriptionWebsitesSeeder::class);
        $finishSubscriptionWebsitesSeedTime = microtime(true);
        $this->command->info('Subscription websites seeded in ' . ($finishSubscriptionWebsitesSeedTime - $startTime) . ' seconds.');

        // seed posts
        $this->command->info('Seeding posts...');
        $startTime = microtime(true);
        $this->command->info('Start time: ' . $startTime . ' seconds.');
        $this->call(PostsSeeder::class);
        $finishPostsSeedTime = microtime(true);
        $this->command->info('Posts seeded in ' . ($finishPostsSeedTime - $startTime) . ' seconds.');

        // seed subscriptions
        $this->command->info('Seeding subscriptions...');
        $startTime = microtime(true);
        $this->command->info('Start time: ' . $startTime . ' seconds.');
        $this->call(UserSubscriptionSeeder::class);
        $finishSubscriptionsSeedTime = microtime(true);
        $this->command->info('Subscriptions seeded in ' . ($finishSubscriptionsSeedTime - $startTime) . ' seconds.');

        // seed payments
        $this->command->info('Seeding payments...');
        $startTime = microtime(true);
        $this->command->info('Start time: ' . $startTime . ' seconds.');
        $this->call(PaymentsSeeder::class);
        $finishPaymentsSeedTime = microtime(true);
        $this->command->info('Payments seeded in ' . ($finishPaymentsSeedTime - $startTime) . ' seconds.');
    }
}
