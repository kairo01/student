<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('name')->after('status'); // Adjust position if needed
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
