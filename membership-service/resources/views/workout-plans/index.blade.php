@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Workout Plans</h2>
    @if (in_array(auth()->user()->role, ['admin', 'trainer']))
        <a href="{{ route('workout-plans.create') }}" class="btn btn-dark">New Plan</a>
    @endif
</div>

@if ($plans === null)
    <div class="alert alert-warning">Training service is not available right now.</div>
@else
    <table class="table table-bordered bg-white">
        <thead>
            <tr><th>Title</th><th>Member</th><th>Trainer</th><th>Start</th><th></th></tr>
        </thead>
        <tbody>
            @forelse ($plans as $plan)
                <tr>
                    <td>{{ $plan['title'] }}</td>
                    <td>{{ $names[$plan['member_id']] ?? '-' }}</td>
                    <td>{{ $names[$plan['trainer_id']] ?? '-' }}</td>
                    <td>{{ $plan['start_date'] }}</td>
                    <td><a href="{{ route('workout-plans.show', $plan['plan_id']) }}" class="btn btn-sm btn-outline-dark">View</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No plans</td></tr>
            @endforelse
        </tbody>
    </table>
@endif
@endsection
