<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('activities', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('parent_id');
          $table->string('parent_type');
          $table->string('type');
          $table->integer('user_id');
          $table->longtext('detail');
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
