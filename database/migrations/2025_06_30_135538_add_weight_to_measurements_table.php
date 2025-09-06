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
        if (!Schema::hasColumn('measurements', 'weight')) {
            Schema::table('measurements', function (Blueprint $table) {
                $table->decimal('weight', 5, 2)->after('height')->comment('Berat badan dalam kg');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('measurements', 'weight')) {
            Schema::table('measurements', function (Blueprint $table) {
                $table->dropColumn('weight');
            });
        }
    }
};