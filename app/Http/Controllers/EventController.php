<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // Fetch all events from the database
        $events = Event::all();

        // Pass events data to the view
        return view('calendar', compact('events'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Create a new event
        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start = $request->input('start');
        $event->end = (new \DateTime($request->input('start')))->modify('+30 minutes')->format('Y-m-d\TH:i');
        $event->save();

        // Return a response
        return response()->json(['success' => true, 'event' => $event]);
    }
}
