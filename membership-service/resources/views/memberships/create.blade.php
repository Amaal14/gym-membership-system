@extends('layouts.app')

@section('content')
<h2>Add Membership</h2>

<form method="POST" action="{{ route('memberships.store') }}" class="card card-body col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="user_id">Member</label>
        <select name="user_id" id="user_id" class="form-select" required>
            @foreach ($members as $member)
                <option value="{{ $member->user_id }}">{{ $member->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="type">Type</label>
        <select name="type" id="type" class="form-select">
            <option value="monthly">Monthly</option>
            <option value="quarterly">Quarterly (3 months)</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="start_date">Start date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>
    <button class="btn btn-dark">Save</button>
</form>
@endsection
