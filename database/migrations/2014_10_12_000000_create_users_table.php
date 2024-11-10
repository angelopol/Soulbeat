<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('UserName',500)->unique();
            $table->string('name',500);
            $table->string('FullName',500);
            $table->longText('biography')->nullable();
            $table->string('photo',500)->nullable();
            $table->longText('followed')->default('~');    
            $table->string('email',500)->unique();
            $table->string('password',500);
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('subscribed')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        User::create([
            'UserName' => 'admin',
            'name' => 'admin',
            'FullName' => 'admin',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'type' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
