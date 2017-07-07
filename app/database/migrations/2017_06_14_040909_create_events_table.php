<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {
	public function up()
	{
               //  Esemeny tabla
		Schema::create('event', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->dateTime('start');
                        $table->dateTime('end');
                        $table->integer('created_by')->unsigned();
                        $table->string('title');
                        $table->longText('description');
                        $table->integer('type');
                        $table->integer('status');
			$table->dateTime('updated_at');
                        $table->dateTime('created_at');

			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

		});

                //  Esemenyhez tartozo csoportok
		Schema::create('event_group', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('group_id')->unsigned();

			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
                        $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');

		});

                //  Esemenyhez tartozo user-ek
		Schema::create('event_user', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('event_id')->unsigned();
                        $table->integer('user_id')->unsigned();

			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
                        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

		});

		Schema::create('event_request', function(Blueprint $table)
                {
                        $table->increments('id')->unsigned();
			$table->string('title');
                        $table->longText('description');
			$table->dateTime('date');
			$table->integer('status');
			$table->dateTime('updated_at');
                        $table->dateTime('created_at');
			
		
                        $table->integer('from_id')->unsigned();
                        $table->integer('to_id')->unsigned();

                        $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
                        $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');

                });

		Schema::create('news', function(Blueprint $table)
                {
                        $table->increments('id')->unsigned();
                        $table->string('title');
                        $table->longText('description');
                        $table->dateTime('updated_at');
                        $table->dateTime('created_at');
                        $table->integer('published_by');
                });
	}


	public function down()
	{
		Schema::drop('event');
                Schema::drop('event_group');
                Schema::drop('event_user');
	}

}
