<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUniqueKeyInNotifiedEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notified_events', function (Blueprint $table) {
            $table->dropUnique(['unique_key']);
            $table->unique(['user_id', 'unique_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notified_events', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'unique_key']);
            $table->unique('unique_key');
        });
    }
}
