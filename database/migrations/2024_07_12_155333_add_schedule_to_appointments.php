<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('appointments', function (Blueprint $table) {
        $table->dateTime('schedule'); // Adjust the data type accordingly
    });
}

public function down()
{
    Schema::table('appointments', function (Blueprint $table) {
        $table->dropColumn('schedule');
    });
}

};
