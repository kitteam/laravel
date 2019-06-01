<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldUserDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_domains', function (Blueprint $table) {
            //$table->unsignedInteger('user_id')->nullable()->comment('Идентификатор пользователя')->change();
            DB::statement("ALTER TABLE `user_domains` CHANGE `user_id` `user_id` INT(10) UNSIGNED NULL COMMENT 'Идентификатор пользователя';");
        });
    }
}
