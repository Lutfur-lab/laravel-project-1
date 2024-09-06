<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Role | Rahaman Readers Club</title>
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
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.75rem;
            color: #333;
            margin-bottom: 20px;
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

        label {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f8f9fa;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .btn-link {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .btn-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
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

        <h1>Edit Role for {{ $user->name }}</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="super_user" {{ $user->role === 'super_user' ? 'selected' : '' }}>Super User</option>
                </select>
            </div>

            <button type="submit">Update Role</button>
        </form>

        <div class="footer">
            <a href="{{ route('users.index') }}" class="btn-link">Back to Users List</a>
        </div>
    </div>
</body>

</html>
