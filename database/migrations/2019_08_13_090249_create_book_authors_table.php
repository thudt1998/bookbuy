<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBookAuthorsTable.
 */
class CreateBookAuthorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_authors', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('book_id')->references('id')->on('books');
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
		Schema::drop('book_authors');
	}
}
