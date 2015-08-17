<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('vote_id');
            $table->integer('join_number');
            $table->string('nickname');
            $table->string('phone',11);
            $table->string('open_id');
            $table->string('image_url');
            $table->integer('voted_count')->index();
            $table->text('join_body');
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
		Schema::drop('vote_users');
	}

}
