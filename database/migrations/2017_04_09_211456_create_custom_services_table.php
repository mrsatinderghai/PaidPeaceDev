<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_services', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('work_order_id');
            $table->integer('quantity');
            $table->decimal('sale_price', 7, 2);
            $table->decimal('line_cost', 7, 2);
            $table->string('name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('custom_services');
    }
}
