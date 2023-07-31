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
        Schema::create('tpictures', function (Blueprint $table) {
            $table->id("PictureId");
            $table->unsignedBigInteger('InvoiceFId');
            $table->foreign('InvoiceFId')->references('InvoiceId')->on('tinvoices');
            $table->string("PictureName");
            $table->string("PicturePath");
            $table->string("PublicUrl");
            $table->string("PictureOriginalName");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpictures');
    }
};
