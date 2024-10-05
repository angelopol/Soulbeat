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
            $table->string('title');
            $table->text('body')->fulltext();
            $table->string('song');
            $table->string('photo');
            $table->float('bpm');
            $table->string('scale');
            $table->string('paid_methods')->toArray();
            $table->integer('cost');
            $table->string('licenses')->toArray();
            $table->text('tags')->toArray();
            $table->integer('reaction_1');
            $table->integer('reaction_2');
            $table->integer('reaction_3');
            $table->integer('reaction_4');
            $table->integer('reaction_5');
            #revisar tipo de dato
            $table->tinyInteger('status');
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
