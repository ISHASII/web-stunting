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
        if (!Schema::hasColumn('measurements', 'head_circumference')) {
            Schema::table('measurements', function (Blueprint $table) {
                $table->decimal('head_circumference', 5, 2)->nullable()->after('weight')->comment('Lingkar kepala dalam cm');
            });
        }

        if (!Schema::hasColumn('measurements', 'arm_circumference')) {
            Schema::table('measurements', function (Blueprint $table) {
                $table->decimal('arm_circumference', 5, 2)->nullable()->after('head_circumference')->comment('Lingkar lengan atas dalam cm');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('measurements', 'head_circumference')) {
            Schema::table('measurements', function (Blueprint $table) {
                $table->dropColumn('head_circumference');
            });
        }

        if (Schema::hasColumn('measurements', 'arm_circumference')) {
            Schema::table('measurements', function (Blueprint $table) {
                $table->dropColumn('arm_circumference');
            });
        }
    }
};