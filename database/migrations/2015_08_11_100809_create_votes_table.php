<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('wechat_id');
            $table->string('name')->index();
            $table->string('pic_url');
            $table->string('description');
            $table->text('rule_body');
            $table->integer('vote_times');
            $table->integer('join_count')->index();
            $table->integer('vote_count')->index();
            $table->integer('view_count')->index();
            $table->timestamp('start_at');
            $table->timestamp('end_at');
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
		Schema::drop('votes');
	}

}
