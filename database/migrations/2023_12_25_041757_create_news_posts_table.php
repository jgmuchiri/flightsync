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
        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->timestamp('published_at');
            $table->string('featured_image')->nullable();
            $table->string('author')->nullable();
            $table->string('url')->nullable();
            $table->json('tags')->nullable();
            $table->json('location')->nullable(); //city,state,country,lat,long
            $table->boolean('hidden')->default(false);
            $table->json('data')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_posts');
    }
};
