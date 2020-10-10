<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadia', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('name');
            $table->string('abv', 3);
            $table->string('url_menu')->nullable();
            $table->string('url_birdseye')->nullable();
            $table->unsignedBigInteger('capacity');
            $table->string('address');
            $table->unsignedBigInteger('year');
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
        Schema::dropIfExists('stadia');
    }
}
