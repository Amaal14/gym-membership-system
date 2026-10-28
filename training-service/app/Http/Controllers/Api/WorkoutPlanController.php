<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    // GET /api/workout-plans?member_id=5  or  ?trainer_id=2
    public function index(Request $request)
    {
        $plans = WorkoutPlan::query();

        if ($request->filled('member_id')) {
            $plans->where('member_id', $request->member_id);
        }

        if ($request->filled('trainer_id')) {
            $plans->where('trainer_id', $request->trainer_id);
        }

        return $plans->latest('start_date')->get();
    }

    // GET /api/workout-plans/{id}
    public function show(WorkoutPlan $workoutPlan)
    {
        return $workoutPlan;
    }

    // POST /api/workout-plans
    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|integer',
            'trainer_id' => 'required|integer',
            'title' => 'required|string|max:100',
            'goal' => 'nullable|string|max:255',
            'exercises' => 'required|string',
            'start_date' => 'required|date',
        ]);

        $plan = WorkoutPlan::create($data);

        return response()->json($plan, 201);
    }
}
