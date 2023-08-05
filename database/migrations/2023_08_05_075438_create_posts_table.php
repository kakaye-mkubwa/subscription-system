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
        Schema::create('posts', function (Blueprint $table) {
            $table = \App\AppUtils\Utils::createDefaultTableColumns($table);

            $table->string('title');
            $table->text('description');
            $table->date('post_date');
            $table->string('author');
            $table->string('url');
            $table->unsignedBigInteger('subscription_website_id');

            // foreign keys
            $table->foreign('subscription_website_id')->references('id')->on('subscription_websites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
