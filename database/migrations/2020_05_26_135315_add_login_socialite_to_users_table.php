<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoginSocialiteToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('provider_name')->nullable()->after('hinh_dai_dien');
            $table->string('provider_id')->nullable()->after('provider_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
            $table->dropColumn('provider_name');
            $table->dropColumn('provider_id');
        });
    }
}
