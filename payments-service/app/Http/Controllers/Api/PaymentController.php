<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // GET /api/payments?member_id=5
    public function index(Request $request)
    {
        $payments = Payment::query();

        if ($request->filled('member_id')) {
            $payments->where('member_id', $request->member_id);
        }

        return $payments->latest('payment_date')->get();
    }

    // POST /api/payments
    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|integer',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'method' => 'required|in:cash,card,transfer',
            'status' => 'required|in:paid,pending',
        ]);

        return response()->json(Payment::create($data), 201);
    }

    // GET /api/reports  -> simple revenue report for the admin
    public function report()
    {
        return [
            'total_paid' => Payment::where('status', 'paid')->sum('amount'),
            'total_pending' => Payment::where('status', 'pending')->sum('amount'),
            'paid_this_month' => Payment::where('status', 'paid')
                ->whereDate('payment_date', '>=', now()->startOfMonth())
                ->sum('amount'),
            'payments_count' => Payment::count(),
        ];
    }
}
