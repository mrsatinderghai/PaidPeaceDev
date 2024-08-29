<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id')->default(null)->nullable();
            $table->string('parent_type')->default(null)->nullable();
            $table->date('due_date');
            $table->datetime('started_at');
            $table->integer('percent_complete');
            $table->integer('assigned_to_user_id');
            $table->boolean('completed');
            $table->timestamp('completed_at');
            $table->string('status');
            $table->integer('assigned_by_user_id');
            $table->timestamp('assigned_at');
            $table->string('priority');
            $table->integer('created_by_user_id');
            $table->boolean('private');
            $table->integer('team_id');

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
        Schema::drop('tasks');
    }
}
