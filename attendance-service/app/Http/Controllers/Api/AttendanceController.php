<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttendanceRecord;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // GET /api/attendance?member_id=5&date=2026-10-28
    public function index(Request $request)
    {
        $records = AttendanceRecord::query();

        if ($request->filled('member_id')) {
            $records->where('member_id', $request->member_id);
        }

        if ($request->filled('date')) {
            $records->whereDate('check_in', $request->date);
        }

        return $records->latest('check_in')->get();
    }

    // POST /api/attendance  -> member checks in now
    public function store(Request $request)
    {
        $request->validate(['member_id' => 'required|integer']);

        $stillInside = AttendanceRecord::where('member_id', $request->member_id)
            ->whereNull('check_out')
            ->exists();

        if ($stillInside) {
            return response()->json(['errors' => ['member_id' => ['This member is already checked in.']]], 422);
        }

        $record = AttendanceRecord::create([
            'member_id' => $request->member_id,
            'check_in' => now(),
        ]);

        return response()->json($record, 201);
    }

    // PUT /api/attendance/{id}/check-out
    public function checkOut(AttendanceRecord $record)
    {
        $record->update(['check_out' => now()]);

        return $record;
    }
}
