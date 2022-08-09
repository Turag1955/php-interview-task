<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_phone');
            $table->unsignedBigInteger('order_no');
            $table->uuid('product_code');
            $table->string('product_name');
            $table->decimal('product_price',13,2);
            $table->unsignedBigInteger('purchase_quantity');
            $table->string('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_reports');
    }
}
