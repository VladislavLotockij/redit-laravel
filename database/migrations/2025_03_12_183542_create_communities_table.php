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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); //TODO: Добавить связь один ко многим для юзеров (для подписок)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
