<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupDetailsToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('group_name');
            $table->unsignedBigInteger('rank');
            $table->unsignedBigInteger('GP');
            $table->unsignedBigInteger('GW');
            $table->unsignedBigInteger('GD');
            $table->unsignedBigInteger('GL');
            $table->BigInteger('GDiff');
            $table->unsignedBigInteger('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('group_name');
            $table->dropColumn('rank');
            $table->dropColumn('GP');
            $table->dropColumn('GW');
            $table->dropColumn('GD');
            $table->dropColumn('GL');
            $table->dropColumn('GDiff');
            $table->dropColumn('points');
        });
    }
}
