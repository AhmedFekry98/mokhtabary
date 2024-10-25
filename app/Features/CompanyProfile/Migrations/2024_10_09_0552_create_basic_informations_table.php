<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basic_informations', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('x')->nullable(); // Twitter (formerly X)
            $table->string('tiktok')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->string('email_address')->nullable();
            $table->text('address')->nullable();
            $table->text('about_us')->nullable();
            $table->timestamps();
        });

        $data = [
            "phone_number"          => "010xxxxx",
            "mobile_number"         => "02xxxxx",
            "whatsapp"              => "https://www.example.com",
            "facebook"              => "https://www.example.com",
            "instagram"             => "https://www.example.com",
            "x"                     => "https://www.example.com",
            "tiktok"                => "https://www.example.com",
            "snapchat"              => "https://www.example.com",
            "linkedin"              => "https://www.example.com",
            "website"               => "https://www.example.com",
            "email_address"         => "email@example.com",
            "address"               => "streetxxxxxxxxxx",
            "about_us"               => "Welcome to Mokhtabary",
        ];

        DB::table('basic_informations')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_informations');
    }
};
