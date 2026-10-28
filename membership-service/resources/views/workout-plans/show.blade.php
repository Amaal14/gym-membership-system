@extends('layouts.app')

@section('content')
<h2>{{ $plan['title'] }}</h2>
<p>
    Member: <strong>{{ $member->name ?? '-' }}</strong> |
    Trainer: <strong>{{ $trainer->name ?? '-' }}</strong> |
    Start: {{ $plan['start_date'] }}
</p>
<p class="text-muted">Goal: {{ $plan['goal'] }}</p>

<div class="card mb-3">
    <div class="card-body">
        <h5>Exercises</h5>
        <ul class="mb-0">
            @foreach (explode("\n", $plan['exercises']) as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>
    </div>
</div>

<a href="{{ route('workout-plans.index') }}" class="btn btn-secondary">Back</a>
@endsection
