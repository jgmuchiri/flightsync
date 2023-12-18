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
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('team_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('roles');
            $table->json('data')->nullable();
            $table->boolean('completed')->default(false);
            $table->index(['team_id','email']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
