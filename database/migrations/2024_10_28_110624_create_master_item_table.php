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
        Schema::create('master_item', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('item_type');
            $table->string('code');
            $table->string('title');
            $table->unsignedBigInteger('item_group_id');
            $table->unsignedBigInteger('item_account_id');
            $table->unsignedBigInteger('item_unit_id');
            $table->boolean('isActive');
            $table->timestamps();

            $table->foreign('item_group_id')->references('item_group_id')->on('items');
            $table->foreign('item_account_id')->references('item_account_id')->on('items_account');
            $table->foreign('item_unit_id')->references('item_unit_id')->on('items_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_item');
    }
};
