@extends('layouts.app')

@section('content')
<h2>New Workout Plan</h2>

<form method="POST" action="{{ route('workout-plans.store') }}" class="card card-body col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="member_id">Member</label>
        <select name="member_id" id="member_id" class="form-select" required>
            @foreach ($members as $member)
                <option value="{{ $member->user_id }}">{{ $member->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- only the admin chooses the trainer, a trainer creates plans for herself --}}
    @if (auth()->user()->role == 'admin')
        <div class="mb-3">
            <label class="form-label" for="trainer_id">Trainer</label>
            <select name="trainer_id" id="trainer_id" class="form-select" required>
                @foreach ($trainers as $trainer)
                    <option value="{{ $trainer->user_id }}">{{ $trainer->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label" for="title">Title</label>
        <input name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="goal">Goal</label>
        <input name="goal" id="goal" class="form-control" value="{{ old('goal') }}">
    </div>
    <div class="mb-3">
        <label class="form-label" for="exercises">Exercises (one per line)</label>
        <textarea name="exercises" id="exercises" rows="4" class="form-control" placeholder="Squats 3x12" required>{{ old('exercises') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="start_date">Start date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>
    <button class="btn btn-dark">Save</button>
</form>
@endsection
