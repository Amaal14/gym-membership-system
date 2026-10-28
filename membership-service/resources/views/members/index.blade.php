@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Members</h2>
    @if (auth()->user()->role == 'admin')
        <a href="{{ route('members.create') }}" class="btn btn-dark">Add Member</a>
    @endif
</div>

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Membership</th></tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            @php $last = $member->memberships->sortByDesc('end_date')->first(); @endphp
            <tr>
                <td>{{ $member->user_id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $last ? $last->type.' ('.$last->status.')' : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
