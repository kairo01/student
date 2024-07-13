<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAppointmentsTable extends Migration
{
    public function store(Request $request)
    {
        DB::table('appointments')->insert([
            'name' => $request->input('name'),
            'course' => $request->input('course'),
            'purpose' => $request->input('purpose'),
            'department' => $request->input('department'),
            'meeting_mode' => $request->input('meeting_mode'),
            'online_preference' => $request->input('online_preference'),
            'schedule' => $request->input('schedule'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
    
}
