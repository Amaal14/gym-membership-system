@extends('layouts.app')

@section('content')
<h2>{{ auth()->user()->role == 'member' ? 'My Visits' : 'Attendance' }}</h2>

@if (auth()->user()->role == 'admin')
    <form method="POST" action="{{ route('attendance.store') }}" class="row g-2 my-3">
        @csrf
        <div class="col-md-4">
            <label class="visually-hidden" for="member_id">Member</label>
            <select name="member_id" id="member_id" class="form-select">
                @foreach ($members as $member)
                    <option value="{{ $member->user_id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-dark">Check In</button></div>
    </form>
@endif

@if ($records === null)
    <div class="alert alert-warning">Attendance service is not available right now.</div>
@else
    <table class="table table-bordered bg-white">
        <thead>
            <tr><th>Member</th><th>Check in</th><th>Check out</th>@if (auth()->user()->role == 'admin')<th></th>@endif</tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $names[$record['member_id']] ?? '-' }}</td>
                    <td>{{ $record['check_in'] }}</td>
                    <td>{{ $record['check_out'] ?? 'Still inside' }}</td>
                    @if (auth()->user()->role == 'admin')
                        <td>
                            @if (! $record['check_out'])
                                <form method="POST" action="{{ route('attendance.checkout', $record['attendance_id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-outline-dark">Check Out</button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="4">No records</td></tr>
            @endforelse
        </tbody>
    </table>
@endif
@endsection
