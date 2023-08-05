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
        Schema::create('invoices', function (Blueprint $table) {
            $table = \App\AppUtils\Utils::createDefaultTableColumns($table);

            $table->unsignedBigInteger('user_subscription_id');
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('amount', 14, 2);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');

            // foreign keys
            $table->foreign('user_subscription_id')->references('id')->on('user_subscriptions');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
