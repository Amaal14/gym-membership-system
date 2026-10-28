@extends('layouts.app')

@section('content')
<h2>Welcome, {{ $user->name }}</h2>
<p class="text-muted">You are logged in as <strong>{{ $user->role }}</strong></p>

@if ($user->role == 'admin')
    <div class="row g-3">
        <div class="col-md-4"><a href="/members" class="card card-body text-decoration-none">Members</a></div>
        <div class="col-md-4"><a href="/memberships" class="card card-body text-decoration-none">Memberships</a></div>
        <div class="col-md-4"><a href="/workout-plans" class="card card-body text-decoration-none">Workout Plans</a></div>
        <div class="col-md-4"><a href="/attendance" class="card card-body text-decoration-none">Attendance</a></div>
        <div class="col-md-4"><a href="/payments" class="card card-body text-decoration-none">Payments & Reports</a></div>
    </div>
@endif

@if ($user->role == 'trainer')
    <div class="row g-3">
        <div class="col-md-4"><a href="/members" class="card card-body text-decoration-none">Members</a></div>
        <div class="col-md-4"><a href="/workout-plans" class="card card-body text-decoration-none">My Workout Plans</a></div>
        <div class="col-md-4"><a href="/attendance" class="card card-body text-decoration-none">Attendance</a></div>
    </div>
@endif

@if ($user->role == 'member')
    <div class="card mb-3">
        <div class="card-body">
            <h5>My Membership</h5>
            @if ($membership)
                <p class="mb-0">
                    {{ ucfirst($membership->type) }} -
                    from {{ $membership->start_date->format('Y-m-d') }} to {{ $membership->end_date->format('Y-m-d') }}
                    <span class="badge {{ $membership->status == 'active' ? 'bg-success' : 'bg-secondary' }}">{{ $membership->status }}</span>
                </p>
            @else
                <p class="mb-0">You don't have a membership yet.</p>
            @endif
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4"><a href="/workout-plans" class="card card-body text-decoration-none">My Workout Plan</a></div>
        <div class="col-md-4"><a href="/attendance" class="card card-body text-decoration-none">My Visits</a></div>
        <div class="col-md-4"><a href="/payments" class="card card-body text-decoration-none">My Payments</a></div>
    </div>
@endif
@endsection
