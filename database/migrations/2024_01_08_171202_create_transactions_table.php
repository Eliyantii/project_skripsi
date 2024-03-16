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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('midtrans_transaction_id');
            $table->String('status', 10);
            $table->string('gross_amount');
            $table->string('payment_type', 20);
            $table->dateTime('transaction_date');
            $table->string('fraud_status', 20)->nullable();
            $table->integer('application_fee');
            $table->integer('administration_fee');
            $table->string('va_number', 20)->nullable();
            $table->string('bank', 100)->nullable();
            $table->string('masked_card', 100)->nullable();
            $table->string('card_type', 100)->nullable();
            $table->string('payment_code')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('user_card');
            $table->string('user_family_card');
            $table->string('owner_response')->default("Menunggu");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
