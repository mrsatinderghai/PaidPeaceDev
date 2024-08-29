<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledSocialNetworkPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('scheduled_social_network_posts', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('platform');
          $table->string('post');
          $table->date('post_date');
          $table->time('post_time');
          $table->tinyInteger('has_fired')->default(0);
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
