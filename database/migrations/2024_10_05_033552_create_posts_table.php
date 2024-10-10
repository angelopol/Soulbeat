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
            $table->integer('user');
            $table->string('title',500);
            $table->longText('body')->nullable();
            $table->string('song',500);
            $table->string('photo')->nullable();
            $table->float('bpm')->nullable();
            $table->string('scale',500)->nullable();
            $table->string('PaidMethods',500)->nullable();
            $table->integer('cost')->default(0);
            $table->string('licenses',500);
            $table->longText('tags')->nullable();
            $table->integer('reaction1')->default(0);
            $table->integer('reaction2')->default(0);
            $table->integer('reaction3')->default(0);
            $table->integer('reaction4')->default(0);
            $table->integer('reaction5')->default(0);
            $table->tinyInteger('status')->default(1);
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
