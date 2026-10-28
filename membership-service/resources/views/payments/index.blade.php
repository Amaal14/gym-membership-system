@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ auth()->user()->role == 'member' ? 'My Payments' : 'Payments' }}</h2>
    @if (auth()->user()->role == 'admin')
        <a href="{{ route('payments.create') }}" class="btn btn-dark">Add Payment</a>
    @endif
</div>

@if ($report)
    <div class="row g-3 mb-3">
        <div class="col-md-3"><div class="card card-body">Total paid<br><strong>{{ $report['total_paid'] }} SAR</strong></div></div>
        <div class="col-md-3"><div class="card card-body">Paid this month<br><strong>{{ $report['paid_this_month'] }} SAR</strong></div></div>
        <div class="col-md-3"><div class="card card-body">Pending<br><strong>{{ $report['total_pending'] }} SAR</strong></div></div>
        <div class="col-md-3"><div class="card card-body">Number of payments<br><strong>{{ $report['payments_count'] }}</strong></div></div>
    </div>
@endif

@if ($payments === null)
    <div class="alert alert-warning">Payments service is not available right now.</div>
@else
    <table class="table table-bordered bg-white">
        <thead>
            <tr><th>Member</th><th>Amount</th><th>Date</th><th>Method</th><th>Status</th></tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $names[$payment['member_id']] ?? '-' }}</td>
                    <td>{{ $payment['amount'] }} SAR</td>
                    <td>{{ $payment['payment_date'] }}</td>
                    <td>{{ $payment['method'] }}</td>
                    <td><span class="badge {{ $payment['status'] == 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $payment['status'] }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5">No payments</td></tr>
            @endforelse
        </tbody>
    </table>
@endif
@endsection
