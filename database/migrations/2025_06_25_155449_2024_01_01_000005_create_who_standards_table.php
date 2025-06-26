<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('who_standards', function (Blueprint $table) {
            $table->id();
            $table->integer('age_months');
            $table->enum('gender', ['L', 'P']);
            $table->decimal('minus_3sd', 5, 2);
            $table->decimal('minus_2sd', 5, 2);
            $table->decimal('minus_1sd', 5, 2);
            $table->decimal('median', 5, 2);
            $table->decimal('plus_1sd', 5, 2);
            $table->decimal('plus_2sd', 5, 2);
            $table->decimal('plus_3sd', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('who_standards');
    }
};