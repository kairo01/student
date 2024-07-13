<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('course')->after('name'); // Adjust position if needed
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('course');
        });
    }
}
