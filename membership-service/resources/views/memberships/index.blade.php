@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ auth()->user()->role == 'member' ? 'My Memberships' : 'Memberships' }}</h2>
    @if (auth()->user()->role == 'admin')
        <a href="{{ route('memberships.create') }}" class="btn btn-dark">Add Membership</a>
    @endif
</div>

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>Member</th><th>Type</th><th>Start</th><th>End</th><th>Status</th></tr>
    </thead>
    <tbody>
        @forelse ($memberships as $m)
            <tr>
                <td>{{ $m->user->name }}</td>
                <td>{{ ucfirst($m->type) }}</td>
                <td>{{ $m->start_date->format('Y-m-d') }}</td>
                <td>{{ $m->end_date->format('Y-m-d') }}</td>
                <td><span class="badge {{ $m->status == 'active' ? 'bg-success' : 'bg-secondary' }}">{{ $m->status }}</span></td>
            </tr>
        @empty
            <tr><td colspan="5">No memberships</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
