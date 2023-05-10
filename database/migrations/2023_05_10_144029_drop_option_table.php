<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('item_option');
        Schema::dropIfExists('options');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
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

        Schema::create('item_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('option_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }
};
