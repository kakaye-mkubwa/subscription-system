<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table = \App\AppUtils\Utils::createDefaultTableColumns($table);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_website_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->enum('payment_status', ['active', 'inactive', 'expired'])->default('inactive');

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subscription_website_id')->references('id')->on('subscription_websites');

            // unique index for user and subscription website id
            $table->unique(['user_id','subscription_website_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
