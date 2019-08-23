<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShortlinksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shortlinks', function (Blueprint $table) {
            $table->increments('id')->comment('Идентификатор');
            $table->timestamps();
            $table->char('shortlink')->unique()->comment('Идентификатор для короткой ссылки');
            $table->char('url')->comment('Адрес ссылки');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shortlinks');
    }

}
