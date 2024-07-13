<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        // Example: return a view for consultation listing
        return view('consultation');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'meeting_mode' => 'required|string|max:255',
            'online_preference' => 'required_if:meeting_mode,online|string|max:255',
            'schedule' => 'required|date',
        ]);

        // Insert new appointment into the database
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

        // Return a response or redirect
        return redirect()->route('consultation.index')->with('success', 'Consultation appointment created successfully!');
    }
}
