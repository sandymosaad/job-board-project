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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->enum('workType', ['remote', 'onsite', 'hybrid'])->nullable();
            $table->string('location')->nullable();
            $table->string('skills')->nullable();
            $table->string('salaryRange')->nullable();
            $table->text('benefites')->nullable();
            $table->string('logo')->nullable();
            $table->string('category')->nullable();
            $table->enum('status', allowed: ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

