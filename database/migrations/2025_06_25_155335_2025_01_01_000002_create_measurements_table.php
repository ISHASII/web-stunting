<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->date('measurement_date');
            $table->decimal('weight', 5, 2); // in kg
            $table->decimal('height', 5, 2); // in cm
            $table->decimal('head_circumference', 5, 2)->nullable(); // in cm
            $table->decimal('arm_circumference', 5, 2)->nullable(); // in cm
            $table->enum('status', ['Normal', 'Pendek', 'Sangat Pendek'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['child_id', 'measurement_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('measurements');
    }
};
