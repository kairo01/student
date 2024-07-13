<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $appointments = Appointment::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->where('status', 'pending')->get();

        return view('approve-disapprove', compact('appointments', 'search'));
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        return redirect('/approve-disapprove')->with('success', 'Appointment approved successfully.');
    }

    public function disapprove($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'disapproved';
        $appointment->save();

        return redirect('/approve-disapprove')->with('success', 'Appointment disapproved successfully.');
    }

    public function delete(Request $request)
    {
        $ids = explode(',', $request->input('idsToDelete'));
        Appointment::whereIn('id', $ids)->delete();

        return redirect('/approve-disapprove')->with('success', 'Selected appointments deleted successfully.');
    }
}
