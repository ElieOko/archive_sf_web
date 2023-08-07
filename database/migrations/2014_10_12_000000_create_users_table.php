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
        Schema::create('TUsers', function (Blueprint $table) {
            $table->id("UserId");
            $table->string('username')->default("Soficom_it");
            $table->string('password');
            $table->string('serialNumber')->nullable();
            $table->string('smstoken')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
        
            $table->unsignedBigInteger('BranchFId');
            $table->foreign('BranchFId')->references('BranchId')->on('TBranches');
            // $table->foreign('BranchFId')->references('BranchId')->on('t_branches');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
