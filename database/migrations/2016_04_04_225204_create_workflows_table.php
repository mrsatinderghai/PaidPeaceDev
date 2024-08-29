<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('workflows', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('parent_type');
            $table->string('assign_type');
            $table->integer('assign_to');
            $table->string('assign_when');
            $table->string('priority');
            $table->date('due_date');
            $table->string('name');
            $table->integer('team_id');
            $table->integer('has_fired');
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
