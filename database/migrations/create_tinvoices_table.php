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
        Schema::create('TInvoicesHidden', function (Blueprint $table) {
            $table->id("InvoiceId");
            $table->string("InvoiceCode")->nullable();
            $table->string("InvoiceDesc")->nullable();
            $table->string("InvoiceBarCode")->nullable();
            $table->unsignedBigInteger('UserFId');
            $table->foreign('UserFId')->references('UserId')->on('TUsers');
            $table->unsignedBigInteger('DirectoryFId');
            $table->foreign('DirectoryFId')->references('DirectoryId')->on('TDirectories');
            $table->unsignedBigInteger('BranchFId');
            $table->foreign('BranchFId')->references('BranchId')->on('TBranches');
            $table->date("InvoiceDate");
            $table->unsignedBigInteger('InvoiceKeyFId')->nullable();
            $table->foreign('InvoicekeyFId')->references('InvoiceKeyId')->on('TInvoiceKeys');
            $table->string("InvoicePath")->nullable();
            $table->string("AndroidVersion")->nullable();
            $table->string("InvoiceUniqueId")->nullable();
            $table->string("ClientName")->nullable();
            $table->string("ClientPhone")->nullable();
            $table->date("ExpiredDate")->nullable();
            $table->datetime('CreatedAt')->nullable();
            $table->datetime('UpdateAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TInvoicesHidden');
    }
};
