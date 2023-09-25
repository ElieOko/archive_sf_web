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
            $table->string('UserName');
            $table->string('UserPass');
            $table->integer('Admin')->default(0);
            $table->string('SerialNumber')->nullable();
            $table->string('SMSToken')->nullable();
            $table->string('SMSTokenExpiry')->nullable();
            $table->string('Phone')->nullable();
            $table->string('WebAccess')->nullable();
            $table->string('DbUser')->nullable();
            $table->string('DbPass')->nullable();
            $table->string('ClientName')->nullable();
            $table->string('ClientPhoneNumber')->nullable();
            $table->unsignedBigInteger('BranchFId');
            $table->foreign('BranchFId')->references('BranchId')->on('TBranches');
            $table->rememberToken();
           
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TUsers');
    }

};
