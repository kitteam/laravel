<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldUserDomainsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_domains', function (Blueprint $table) {
            $table->longtext('details')->nullable()->comment('Дополнительная информация по домену');
        });
    }
}
