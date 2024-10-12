<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->dateTime('phone_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        
        $data = [
            'email'     => "admin@example.com",  
            'phone'     => "01012182626", 
            'password'  => Hash::make('password'), 
        ];

        $role       = ['user_id' => 1 , 'role_id' => 1];

        $admin      = DB::table('users')->insert($data);
        $userRole   = DB::table('user_roles')->insert($role);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
