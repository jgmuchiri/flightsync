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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('slogan')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('team_user', function(Blueprint $table){
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Team::class);
            $table->json('roles')->nullable();
            $table->string('status')->default(\App\Models\TeamUser::STATUS_ACTIVE);
            $table->unique(['user_id','team_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_user');
        Schema::dropIfExists('teams');
    }
};
