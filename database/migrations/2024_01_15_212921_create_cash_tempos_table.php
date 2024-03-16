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
        Schema::create('cash_tempos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('customer_name', 100);
            $table->string('address', 100);
            $table->string('phone', 15);
            $table->string('guarantor_phone', 15);
            $table->string('work');
            $table->string('income');
            $table->integer('unit');
            $table->integer('month');
            $table->double('dp');
            $table->double('interest')->default(0.0);
            $table->double('total_interest')->default(0.0);
            $table->double('installment')->nullable();
            $table->string('user_card');
            $table->string('user_family_card');
            $table->string('status', 20);
            $table->string('date_taken');
            $table->integer('remaining_total')->nullable();
            $table->timestamp('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_tempos');
    }
};
