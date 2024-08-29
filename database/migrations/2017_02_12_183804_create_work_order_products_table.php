<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('work_order_product', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('work_order_id');
          $table->integer('product_id');
          $table->decimal('tax', 7, 2);
          $table->decimal('sale_price', 7, 2);
          $table->decimal('line_cost', 7, 2);
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_order_product');
    }
}
