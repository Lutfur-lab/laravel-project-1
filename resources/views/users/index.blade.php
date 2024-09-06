<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | Rahaman Readers Club</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .user-info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .user-info div {
            font-size: 1rem;
            color: #495057;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        ul li:last-child {
            border-bottom: none;
        }

        .role-badge {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.875rem;
            margin-right: 10px;
        }

        .btn-link {
            color: #007bff;
            text-decoration: none;
            font-size: 0.875rem;
            padding: 5px 10px;
            transition: all 0.2s ease-in-out;
        }

        .btn-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- User Info Section -->
        <div class="user-info mb-4">
            <div><strong>{{ Auth::user()->name }}</strong></div>
            <div>{{ Auth::user()->email }}</div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="mb-4">
            <a href="{{ route('profile.edit') }}" class="btn-link">Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}" class="btn-link"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </a>
            </form>
        </div>

        <h1>User Management</h1>

        <!-- Success Message -->
        @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- User List -->
        <ul>
            @foreach($users as $user)
            <li>
                <span>
                    <span class="role-badge">{{ $user->role }}</span>
                    {{ $user->name }} - {{ $user->email }}
                </span>
                <a href="{{ route('users.edit', $user->id) }}" class="btn-link">Edit Role</a>
            </li>
            @endforeach
        </ul>

        <!-- Back to Dashboard -->
        <div class="footer">
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>
