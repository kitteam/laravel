<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tlds');
        Schema::create('tlds', function (Blueprint $table) {
            $table->increments('id')->comment('Идентификатор');
            //$table->nullableTimestamps();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));;
            $table->enum('state', ['activated', 'suspended', 'inactivated', 'deleted'])->default('activated')->comment('Состояние');
            $table->enum('provider', ['reg.ru','nic.ru'])->default('reg.ru')->comment('Поставщик услуг');
            $table->string('tld')->comment('Домен верхнего уровня');
            $table->boolean('idn')->comment('Поддержка IDN');
            $table->integer('reg_price')->comment('Стоимость регистрации');
            $table->integer('retail_reg_price')->comment('Розничная стоимость регистрации');
            $table->integer('reg_min_period')->comment('Минимальный период регистрации');
            $table->integer('reg_max_period')->comment('Максимальный период регистрации');
            $table->integer('renew_price')->nullable()->comment('Стоимость продления');
            $table->integer('retail_renew_price')->nullable()->comment('Розничная стоимость продления');
            $table->integer('renew_min_period')->nullable()->comment('Минимальный период продления');
            $table->integer('renew_max_period')->nullable()->comment('Максимальный период продления');
            $table->integer('update_contacts_price')->nullable()->comment('Стоимость обновления');
            $table->integer('update_nameservers_price')->nullable()->comment('Стоимость изменения DNS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlds');
    }
}
