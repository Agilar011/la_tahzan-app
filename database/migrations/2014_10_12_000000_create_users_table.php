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
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('age')->nullable();
            $table->enum('gender', ['Pria', 'Wanita'])->nullable();
            $table->enum('status_seller', ['Common', 'VIP', 'Star Seller']);
            $table->string('email')->unique();
            $table->string('ktp')->nullable()->unique();
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->enum('role', ['admin', 'customer', 'seller'])->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
