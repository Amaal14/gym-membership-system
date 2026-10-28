<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Api;
use Illuminate\Http\Request;

// Pages for the Training service (data comes from its API)
class WorkoutPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $filters = [];

        // a member sees her plans, a trainer sees the plans she made
        if ($user->role == 'member') {
            $filters['member_id'] = $user->user_id;
        } elseif ($user->role == 'trainer') {
            $filters['trainer_id'] = $user->user_id;
        }

        $plans = Api::get('training', 'workout-plans', $filters);
        $names = User::pluck('name', 'user_id');

        return view('workout-plans.index', compact('plans', 'names'));
    }

    public function show($id)
    {
        $plan = Api::get('training', "workout-plans/$id");

        if (! $plan) {
            abort(404);
        }

        $user = auth()->user();

        // a member can only open her plan, a trainer only the plans she made
        if ($user->role == 'member' && $plan['member_id'] != $user->user_id) {
            abort(403);
        }
        if ($user->role == 'trainer' && $plan['trainer_id'] != $user->user_id) {
            abort(403);
        }

        $member = User::find($plan['member_id']);
        $trainer = User::find($plan['trainer_id']);

        return view('workout-plans.show', compact('plan', 'member', 'trainer'));
    }

    // admin and trainer
    public function create()
    {
        $members = User::where('role', 'member')->orderBy('name')->get();
        $trainers = User::where('role', 'trainer')->orderBy('name')->get();

        return view('workout-plans.create', compact('members', 'trainers'));
    }

    public function store(Request $request)
    {
        $data = $request->only('member_id', 'trainer_id', 'title', 'goal', 'exercises', 'start_date');

        // a trainer always creates the plan with her own name
        if (auth()->user()->role == 'trainer') {
            $data['trainer_id'] = auth()->id();
        }

        $response = Api::post('training', 'workout-plans', $data);

        if (! $response) {
            return back()->with('error', 'Training service is not running')->withInput();
        }
        if ($response->status() == 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        return redirect()->route('workout-plans.index')->with('success', 'Workout plan created');
    }
}
