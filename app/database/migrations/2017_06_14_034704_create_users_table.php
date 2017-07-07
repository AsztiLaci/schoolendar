<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
                //  felhasznalok tabla
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
                        $table->string('email', 100);
                        $table->string('password');
                        $table->string('displayname');
                        $table->integer('type');
			$table->string('remember_token');
			$table->dateTime('updated_at');
			$table->dateTime('created_at');
		});
                //  csoportok tabla
                Schema::create('group', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
                        $table->string('name');
		});
                //  felhasznalok csoportjai tabla
                Schema::create('user_groups', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('group_id')->unsigned();

                        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                        $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
		});
	}
	public function down()
	{
		Schema::drop('user');
                Schema::drop('group');
                Schema::drop('user_groups');
	}

}
