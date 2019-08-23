<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldUserDomainsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_domains', function (Blueprint $table) {
            DB::statement("ALTER TABLE `user_domains` CHANGE `state` `state` ENUM('activated','suspended','inactivated','deleted','transferred') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactivated' COMMENT 'Состояние';");
        });
    }
}
