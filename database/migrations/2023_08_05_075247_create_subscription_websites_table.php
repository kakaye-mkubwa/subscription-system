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
        Schema::create('subscription_websites', function (Blueprint $table) {
            $table = \App\AppUtils\Utils::createDefaultTableColumns($table);

            $table->string('website_name')->unique();
            $table->string('website_url')->unique();
            $table->string('description');
            $table->decimal('price', 14, 2);
            $table->integer('duration_in_months');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_websites');
    }
};
