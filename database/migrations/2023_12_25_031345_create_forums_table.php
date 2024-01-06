<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->foreignIdFor(\App\Models\Forum::class, 'parent_id')
                ->nullable()
                ->constrained('forums')
                ->restrictOnDelete();
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->string('icon')->nullable();
            $table->boolean('is_private')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('forum_threads', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content');
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->foreignIdFor(\App\Models\Forum::class, 'parent_id')
                ->constrained('forum_threads')
                ->cascadeOnDelete();;
            $table->softDeletes();
        });

        Schema::create('forum_reactions', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_reactions');
        Schema::dropIfExists('forum_threads');
        Schema::dropIfExists('forums');
    }
};
