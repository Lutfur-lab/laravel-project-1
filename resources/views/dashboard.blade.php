<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        .jumbotron {
            background-color: #ffc107;
            color: #000;
            padding: 3rem 1rem;
            margin-bottom: 30px;
        }
        h1, h2, h3 {
            color: #000;
        }
        .btn-custom {
            border-radius: 30px;
            padding: 10px 25px;
            font-size: 18px;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }
        .btn-custom:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: auto;
            max-width: 200px;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease;
            height: 100%;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .footer {
            background-color: #ffc107;
            color: #000;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        footer a {
            color: #000;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Welcome Banner -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Rahaman Readers Club</h1>
        <p class="lead">Discover, Read, and Share Your Favorite Books</p>
    </div>

    <!-- Dashboard with 6 Books -->
    <div class="container">
        <h2 class="text-center mb-4">Featured Books</h2>
        <div class="row">
            @foreach ($books->take(6) as $book)
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        @if($book->cover_art)
                            <img src="{{ asset($book->cover_art) }}" alt="{{ $book->title }}" class="card-img-top mx-auto mt-3">
                        @else
                            <img src="https://via.placeholder.com/200x300?text=No+Image" alt="No cover art available" class="card-img-top mx-auto mt-3">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->authors }}</p>
                            <a href="{{ auth()->check() ? route('books.show', $book->id) : route('login') }}" class="btn btn-custom btn-primary">
                                Book Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Rahaman Readers Club. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
