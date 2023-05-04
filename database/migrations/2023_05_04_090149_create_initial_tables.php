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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('code');
            $table->string('name');
            $table->string('receipt_name');
            $table->text('description')->nullable();
            $table->mediumInteger('price');
            $table->mediumInteger('tax');
            $table->mediumInteger('tax_excluded_price');
            $table->tinyInteger('sort_order');
            $table->tinyInteger('disabled');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('code');
            $table->string('name');
            $table->string('receipt_name');
            $table->mediumInteger('price');
            $table->mediumInteger('tax');
            $table->mediumInteger('tax_excluded_price');
            $table->string('group_key')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('total_price');
            $table->mediumInteger('total_tax');
            $table->mediumInteger('total_tax_excluded_price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->smallInteger('order_no');
            $table->tinyInteger('sequence');
            $table->tinyInteger('quantity');
            $table->date('order_date');
            $table->string('order_group_key');
            $table->string('custom_ids');
            $table->timestamp('delivered_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('receipt_id')->references('id')->on('receipts')->onDelete('SET NULL')->onUpdate('CASCADE');
        });

        Schema::create('category_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::create('item_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('option_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_item');
        Schema::dropIfExists('item_option');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('items');
        Schema::dropIfExists('options');
        Schema::dropIfExists('receipts');
    }
};
