<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_domains', function (Blueprint $table) {
            $table->increments('id')->comment('Идентификатор');
            $table->enum('provider', ['reg.ru','nic.ru'])->default('reg.ru')->comment('Поставщик услуг');
            $table->string('id_code')->comment('Идентификатор у поставщика услуг');
            $table->unsignedInteger('user_id')->comment('Идентификатор пользователя');
            $table->string('domain')->comment('Доменное имя');
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
        Schema::dropIfExists('user_domains');
    }
}
