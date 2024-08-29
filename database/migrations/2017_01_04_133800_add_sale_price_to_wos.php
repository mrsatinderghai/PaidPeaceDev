<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalePriceToWos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_order_service', function (Blueprint $table) {
            $table->decimal('labor_hours', 7, 2);
            $table->decimal('sale_price', 7, 2);
            $table->decimal('line_cost', 7, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_order_service', function (Blueprint $table) {
            //
        });
    }
}
