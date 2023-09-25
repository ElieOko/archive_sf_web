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
        Schema::create('TUsersDirectories', function (Blueprint $table) {
            $table->id("UserDirectoryId");
            $table->unsignedBigInteger('UserFId');
            $table->foreign('UserFId')->references('UserId')->on('TUsers');
            $table->unsignedBigInteger('DirectoryFId');
            $table->foreign('DirectoryFId')->references('DirectoryId')->on('TDirectories');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TUsersDirectories');
    }
};
