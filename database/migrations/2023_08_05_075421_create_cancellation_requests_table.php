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
        Schema::create('cancellation_requests', function (Blueprint $table) {
            $table = \App\AppUtils\Utils::createDefaultTableColumns($table);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_website_id');
            $table->date('request_date');
            $table->date('approval_date')->nullable();
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('reason');

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subscription_website_id')->references('id')->on('subscription_websites');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellation_requests');
    }
};
