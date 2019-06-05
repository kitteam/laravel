<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostings', function (Blueprint $table) {
            $table->increments('id')->comment('Идентификатор');
            $table->string('name')->comment('Название тарифа');
            $table->enum('provider', ['kit.team','reg.ru'])->default('kit.team')->comment('Поставщик услуг');
            $table->decimal('price', 5, 2)->comment('Стоимость');
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
        Schema::table('hostings', function (Blueprint $table) {
            //
        });
    }
}
