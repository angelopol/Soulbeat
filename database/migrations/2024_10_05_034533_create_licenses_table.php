<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\License;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('name',500);
            $table->longText('feature');
            $table->integer('post')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        License::create([
            'name' => 'Uso general',
            'feature' => 'De uso general~gratuita'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
