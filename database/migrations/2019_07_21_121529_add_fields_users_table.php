<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->unique()->after('email')->comment('Номер телефона');
            $table->string('middlename')->nullable()->after('name')->comment('Отчество');
            $table->string('surname')->nullable()->after('middlename')->comment('Фамилия');
            $table->date('birthdate')->nullable()->after('surname')->comment('Дата рождения');
            $table->text('address')->nullable()->after('birthdate')->comment('Адрес регистрации');
            $table->text('passport')->nullable()->after('address')->comment('Паспортные данные');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
