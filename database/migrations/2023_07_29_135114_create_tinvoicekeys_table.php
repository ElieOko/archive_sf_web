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
        Schema::create('TInvoiceKeys', function (Blueprint $table) {
            $table->id("InvoicekeyId");
            $table->string("Invoicekey");
            $table->unsignedBigInteger('DirectoryFId');
            $table->foreign('DirectoryFId')->references('DirectoryId')->on('TDirectories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tinvoicekeys');
    }
};
