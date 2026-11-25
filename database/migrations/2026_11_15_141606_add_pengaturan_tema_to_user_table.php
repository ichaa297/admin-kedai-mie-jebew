<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('tema')->default('biru');
            $table->string('warna_utama')->default('#1572E8');
            $table->string('warna_latar')->default('#F5F7FD');
        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn([
                'tema',
                'warna_utama',
                'warna_latar',
            ]);
        });
    }
};