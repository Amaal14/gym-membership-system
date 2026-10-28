<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/home">Gym System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>

                @if (in_array(auth()->user()->role, ['admin', 'trainer']))
                    <li class="nav-item"><a class="nav-link" href="/members">Members</a></li>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'member']))
                    <li class="nav-item"><a class="nav-link" href="/memberships">Memberships</a></li>
                @endif

                <li class="nav-item"><a class="nav-link" href="/workout-plans">Workout Plans</a></li>
                <li class="nav-item"><a class="nav-link" href="/attendance">Attendance</a></li>

                @if (in_array(auth()->user()->role, ['admin', 'member']))
                    <li class="nav-item"><a class="nav-link" href="/payments">Payments</a></li>
                @endif
            </ul>

            <span class="navbar-text me-3">
                {{ auth()->user()->name }} <span class="badge bg-secondary">{{ auth()->user()->role }}</span>
            </span>
            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>
@endauth

<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
