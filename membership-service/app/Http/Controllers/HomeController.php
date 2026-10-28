<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // a member sees her current membership on the home page
        $membership = $user->role == 'member'
            ? $user->memberships()->latest('end_date')->first()
            : null;

        return view('home', compact('user', 'membership'));
    }
}
