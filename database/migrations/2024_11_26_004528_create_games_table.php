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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained('platforms')->cascadeOnDelete;
            $table->foreignId('genre_id')->constrained('genres')->cascadeOnDelete;
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('thumbnail')->nullable();
            $table->string('summary')->nullable();
            $table->longText('description')->nullable();
            $table->json('screenshots')->nullable();
            $table->string('developer')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('requirement')->nullable();
            $table->longText('howtoinstall')->nullable();
            $table->string('game_size')->nullable();
            $table->string('link1')->nullable();
            $table->string('link2')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
