<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Api;
use Illuminate\Http\Request;

// Pages for the Attendance service
class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $filters = $request->only('member_id', 'date');

        // a member only sees her own visits
        if ($user->role == 'member') {
            $filters = ['member_id' => $user->user_id];
        }

        $records = Api::get('attendance', 'attendance', $filters);
        $names = User::pluck('name', 'user_id');
        $members = User::where('role', 'member')->orderBy('name')->get();

        return view('attendance.index', compact('records', 'names', 'members'));
    }

    // admin: check in a member
    public function store(Request $request)
    {
        $response = Api::post('attendance', 'attendance', $request->only('member_id'));

        if (! $response) {
            return back()->with('error', 'Attendance service is not running');
        }
        if ($response->status() == 422) {
            return back()->withErrors($response->json('errors'));
        }

        return back()->with('success', 'Check in saved');
    }

    // admin: check out
    public function checkOut($id)
    {
        $response = Api::put('attendance', "attendance/$id/check-out");

        if (! $response || $response->failed()) {
            return back()->with('error', 'Could not save the check out');
        }

        return back()->with('success', 'Check out saved');
    }
}
