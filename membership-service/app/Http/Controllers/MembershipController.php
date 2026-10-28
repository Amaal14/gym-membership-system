<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MembershipController extends Controller
{
    // admin sees all, member sees only hers
    public function index()
    {
        $user = auth()->user();

        $memberships = Membership::with('user')->latest('start_date');

        if ($user->role == 'member') {
            $memberships->where('user_id', $user->user_id);
        }

        return view('memberships.index', ['memberships' => $memberships->get()]);
    }

    // admin only
    public function create()
    {
        $members = User::where('role', 'member')->orderBy('name')->get();

        return view('memberships.create', compact('members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'type' => 'required|in:monthly,quarterly,yearly',
            'start_date' => 'required|date',
        ]);

        // end date depends on the membership type
        $data['end_date'] = Carbon::parse($data['start_date'])->addMonths(Membership::$months[$data['type']]);
        $data['status'] = 'active';

        Membership::create($data);

        return redirect()->route('memberships.index')->with('success', 'Membership added');
    }
}
