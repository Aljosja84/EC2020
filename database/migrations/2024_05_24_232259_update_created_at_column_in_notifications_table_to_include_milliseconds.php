<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $connection = DB::connection()->getPdo();

        if ($connection->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
            DB::statement('ALTER TABLE notifications MODIFY created_at DATETIME(3) NULL');
        } else {
            Schema::table('notifications', function (Blueprint $table) {
                $table->dateTimeTz('created_at', 3)->nullable()->change();
            });
        }
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable()->change();
        });
    }
};
