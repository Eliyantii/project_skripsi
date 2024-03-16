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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('postal_code', 10);
            $table->string('phone', 15);
            $table->string('email', 100);
            $table->string('account_number', 50);
            $table->string('account_name', 100);
            $table->string('bank', 100);
            $table->string('tax_number', 100);
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
