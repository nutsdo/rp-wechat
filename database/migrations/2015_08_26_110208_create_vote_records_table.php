<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_records', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('wechat_id');
            $table->integer('vote_id');
            $table->integer('open_id');
            $table->integer('player_id');
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
		Schema::drop('vote_records');
	}

}
