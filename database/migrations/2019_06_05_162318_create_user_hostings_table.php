<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_hostings', function (Blueprint $table) {
            $table->increments('id')->comment('Идентификатор');
            $table->unsignedInteger('hosting_id')->comment('Идентификатор хостинг услуги');
            $table->unsignedInteger('user_id')->comment('Идентификатор пользователя');
            $table->string('server')->comment('Сервер');
            $table->string('account')->comment('Учетная запись');
            $table->enum('state', ['activated', 'suspended', 'locked'])->default('activated')->comment('Состояние');
            $table->timestamps();
            $table->timestamp('expiration_at')->nullable()->comment('Окончание');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_hosting', function (Blueprint $table) {
            //
        });
    }
}
