<?php

use App\Models\PaidMethod;
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
        Schema::create('paid_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name',500);
            $table->string('description',500)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        PaidMethod::create([
            'name' => 'Divisas',
            'description' => 'Divisas en fisico'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paid_methods');
    }
};
