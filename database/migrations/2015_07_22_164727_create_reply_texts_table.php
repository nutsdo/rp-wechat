<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTextsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reply_texts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('content');
            $table->integer('reply_id')->unsigned();
			$table->timestamps();

            $table->foreign('reply_id')->references('id')->on('replies')
                ->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('reply_texts', function (Blueprint $table) {
            $table->dropForeign('reply_texts_reply_id_foreign');
        });
		Schema::drop('reply_texts');
	}

}
