<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeDiscountCancelreasonToWo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('work_orders', function (Blueprint $table) {
          $table->string('code')->nullable()->default(null);
          $table->string('discount')->nullable()->default(null);
          $table->string('cancellation_reason')->nullable()->default(null);
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
