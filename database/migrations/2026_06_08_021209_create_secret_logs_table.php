<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('secret_logs', function (Blueprint $table) {
            $table->id();
            $table->string('token', 64)->index();
            $table->string('ip_address', 45)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->enum('event', ['viewed', 'failed_password', 'expired'])->default('viewed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secret_logs');
    }
};