<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained()->onDelete('cascade');
            $table->foreignId('cinema_id')->constrained()->onDelete('cascade');
            $table->date('show_date'); // tanggal tayang
            $table->time('show_time'); // jam tayang
            $table->integer('studio'); // studio tempat tayang
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
