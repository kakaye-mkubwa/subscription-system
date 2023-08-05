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
        Schema::create('payments', function (Blueprint $table) {
            $table = \App\AppUtils\Utils::createDefaultTableColumns($table);

            $table->unsignedBigInteger('invoice_id');
            $table->decimal('amount', 14, 2);
            $table->string('description');
            $table->date('date_paid');
            $table->string('paid_by');

            // foreign keys
            $table->foreign('invoice_id')->references('id')->on('invoices');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
