<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBookImagesTable.
 */
class CreateBookImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_images', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->unsigned();
            $table->string('path');
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
		Schema::drop('book_images');
	}
}
