<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Api;
use Illuminate\Http\Request;

// Pages for the Payments & Reports service
class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $filters = $user->role == 'member' ? ['member_id' => $user->user_id] : [];

        $payments = Api::get('payments', 'payments', $filters);
        $report = $user->role == 'admin' ? Api::get('payments', 'reports') : null;
        $names = User::pluck('name', 'user_id');

        return view('payments.index', compact('payments', 'report', 'names'));
    }

    // admin only
    public function create()
    {
        $members = User::where('role', 'member')->orderBy('name')->get();

        return view('payments.create', compact('members'));
    }

    public function store(Request $request)
    {
        $response = Api::post('payments', 'payments',
            $request->only('member_id', 'amount', 'payment_date', 'method', 'status'));

        if (! $response) {
            return back()->with('error', 'Payments service is not running')->withInput();
        }
        if ($response->status() == 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        return redirect()->route('payments.index')->with('success', 'Payment saved');
    }
}
