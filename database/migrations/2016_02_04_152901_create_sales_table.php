<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable()->default(null);
            $table->integer('contact_id')->nullable()->default(null);
            $table->string('name');
            $table->string('status');
            $table->string('product');
            $table->decimal('amount',8,2);
            $table->integer('team_id');
            $table->date('start_date');
            $table->date('close_date');
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
        //
    }
}
