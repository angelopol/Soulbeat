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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->tinyInteger('posts')->default(1);
            $table->tinyInteger('playlist')->default(1);
            $table->tinyInteger('chats')->default(1);
            $table->tinyInteger('payment')->default(1);
            $table->tinyInteger('users')->default(1);
            $table->tinyInteger('licenses')->default(1);
            $table->tinyInteger('PaidMethods')->default(1);
            $table->tinyInteger('guides')->default(1);
            $table->tinyInteger('QA')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
