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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id('transaction_detail_id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('master_item_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('item_unit_id');
            $table->string('note');

            $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('cascade');
            $table->foreign('master_item_id')->references('id')->on('master_item');
            $table->foreign('item_unit_id')->references('item_unit_id')->on('items_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
