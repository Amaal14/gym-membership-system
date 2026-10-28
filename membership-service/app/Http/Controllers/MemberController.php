<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // admin and trainer
    public function index()
    {
        $members = User::where('role', 'member')->with('memberships')->orderBy('name')->get();

        return view('members.index', compact('members'));
    }

    // admin only
    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:8',
        ]);

        $data['role'] = 'member';
        User::create($data);

        return redirect()->route('members.index')->with('success', 'Member added');
    }
}
