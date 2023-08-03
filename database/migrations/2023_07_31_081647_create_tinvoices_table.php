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
        Schema::create('tinvoices', function (Blueprint $table) {
            $table->id("InvoiceId");
            $table->string("InvoiceCode")->nullable();
            $table->string("InvoiceDesc")->nullable();
            $table->string("InvoiceBarCode")->nullable();
            $table->unsignedBigInteger('UserFId');
            $table->foreign('UserFId')->references('id')->on('users');
            $table->unsignedBigInteger('DirectoryFId');
            $table->foreign('DirectoryFId')->references('DirectoryId')->on('tdirectories');
            $table->unsignedBigInteger('BranchFId');
            $table->foreign('BranchFId')->references('BranchId')->on('t_branches');
            $table->timestamps();
            $table->date("InvoiceDate");
            $table->unsignedBigInteger('InvoicekeyFId');
            $table->foreign('InvoicekeyFId')->references('InvoicekeyId')->on('tinvoicekeys');
            $table->string("InvoicePath")->nullable();
            $table->string("AndroidVersion")->nullable();
            $table->string("InvoiceUniqueId")->nullable();
            $table->string("ClientName")->nullable();
            $table->string("ClientPhone")->nullable();
            $table->date("ExpiredDate")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tinvoices');
    }
};
