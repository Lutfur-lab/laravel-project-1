<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Book</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9; /* Light background for a clean look */
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #343a40; /* Dark background */
            color: white;
            padding: 15px 0;
        }
        .header .user-info {
            text-align: center;
            margin-bottom: 10px;
        }
        .header .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .header .btn {
            width: 120px;
        }
        .form-container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #ffffff; /* White background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40; /* Dark text */
            font-weight: bold;
        }
        .form-group label {
            font-weight: bold;
            color: #343a40;
        }
        .form-container .btn-primary {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        .back-to-books {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }
        .back-to-books:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <div class="user-info">
            <h5>{{ Auth::user()->name }}</h5>
            <p>{{ Auth::user()->email }}</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('profile.edit') }}" class="btn btn-info">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Log Out</button>
            </form>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <h1>Add a New Book</h1>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" required>
            </div>

            <div class="form-group">
                <label for="authors">Authors:</label>
                <input type="text" class="form-control" id="authors" name="authors" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" class="form-control" id="publisher" name="publisher" required>
            </div>

            <div class="form-group">
                <label for="edition">Edition:</label>
                <input type="text" class="form-control" id="edition" name="edition" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cover_art">Cover Art (optional):</label>
                <input type="file" class="form-control-file" id="cover_art" name="cover_art">
            </div>

            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>

        <a href="{{ url('/books') }}" class="back-to-books">Back to Books List</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
