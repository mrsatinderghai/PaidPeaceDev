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
            $table->date('due_date')->nullable();
            $table->datetime('started_at')->nullable();
            $table->integer('percent_complete')->nullable();
            $table->integer('assigned_to_user_id')->nullable();
            $table->boolean('completed')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('status')->nullable();
            $table->integer('assigned_by_user_id')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->string('priority')->nullable();
            $table->integer('created_by_user_id')->nullable();
            $table->boolean('private')->nullable();
            $table->integer('team_id')->nullable();

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
