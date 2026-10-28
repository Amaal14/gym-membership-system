@extends('layouts.app')

@section('content')
<h2>Add Payment</h2>

<form method="POST" action="{{ route('payments.store') }}" class="card card-body col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="member_id">Member</label>
        <select name="member_id" id="member_id" class="form-select" required>
            @foreach ($members as $member)
                <option value="{{ $member->user_id }}">{{ $member->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="amount">Amount (SAR)</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="payment_date">Date</label>
        <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="method">Method</label>
        <select name="method" id="method" class="form-select">
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="transfer">Transfer</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="status">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="paid">Paid</option>
            <option value="pending">Pending</option>
        </select>
    </div>
    <button class="btn btn-dark">Save</button>
</form>
@endsection
