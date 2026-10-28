@extends('layouts.app')

@section('content')
<h2>Add Member</h2>

<form method="POST" action="{{ route('members.store') }}" class="card card-body col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="name">Name</label>
        <input name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="phone">Phone</label>
        <input name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button class="btn btn-dark">Save</button>
</form>
@endsection
