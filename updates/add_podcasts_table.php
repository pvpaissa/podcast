<?php

namespace Cleanse\Podcast\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddPodcastsTable extends Migration
{
    public function up()
    {
        Schema::create('cleanse_podcasts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('link');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cleanse_podcasts');
    }
}
