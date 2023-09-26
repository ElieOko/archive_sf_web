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
        Schema::create('TDirectoriesBackup', function (Blueprint $table) {
            $table->id("DirectoryId");
            $table->string("DirectoryName");
            $table->integer("ParentFId")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TDirectoriesBackup');
    }
};
