<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');            // Наименование на услугата
            $table->text('description')->nullable(); // Описание
            $table->decimal('price', 8, 2);    // Цена
            $table->integer('duration_minutes'); // Продължителност в минути
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
