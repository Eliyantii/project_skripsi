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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('user');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('password');
            $table->string('gender', 10);
            $table->string('born');
            $table->string('address', 100);
            $table->string('phone', 15)->unique();
            $table->string('province', 100);
            $table->string('city', 100);
            $table->string('subdistrict', 100);
            $table->string('postal_code', 10);
            $table->string('image');
            $table->integer('balance')->default(0);
            $table->integer('refund_balance')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
