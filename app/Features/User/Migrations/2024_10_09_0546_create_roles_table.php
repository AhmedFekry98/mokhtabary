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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('abilities')->nullable();
            $table->timestamps();
        });

        $data = [
            ['name' => 'admin'],
            ['name' => 'employee'],
            ['name' => 'client'],
            ['name' => 'lab'],
            ['name' => 'radiology'],
            ['name' => 'labBranch'],
            ['name' => 'radiologyBranch'],
        ];

        // Insert roles into the roles table
        DB::table('roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
