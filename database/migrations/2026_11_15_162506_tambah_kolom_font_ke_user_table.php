
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('font_family')->default('Poppins');
            $table->string('font_color')->default('#333333');
            $table->unsignedInteger('font_size')->default(14);
        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn([
                'font_family',
                'font_color',
                'font_size',
            ]);
        });
    }
};
