<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBooksTable.
 */
class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('name');
            $table->bigInteger('publisher_id')->unsigned();
            $table->integer('price');
            $table->integer('sale_price');
            $table->integer('amount');
            $table->integer('pages');
            $table->string('book_size');
            $table->date('year_publish');
            $table->date('date_post');
            $table->longText('description');
            $table->string('age');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('publisher_id')->references('id')->on('publishers');
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
        Schema::drop('books');
    }
}
