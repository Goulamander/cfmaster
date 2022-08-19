<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('product_name');
            $table->string('costs_till_ready_to_sell');
            $table->string('payout_per_unit_by');
            $table->string('ppc_cost_per_product');
            $table->string('deposit_portion');
            $table->string('deposit_leadtime');
            $table->string('payment_delay_amazon');
            $table->string('final_payment_portion');
            $table->string('final_payment_leadtime');
            $table->string('selling_price_for_sales_tax');
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
