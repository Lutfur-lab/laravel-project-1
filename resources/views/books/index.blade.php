<!DOCTYPE html>
<html>
<head>
  <title>Rahaman Readers Hub</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .navbar {
      margin-bottom: 20px;
      color: #d3d3d3;
    }
    .navbar-brand {
      font-weight: bold;
    }
    .navbar-nav .nav-link {
      padding: 15px 20px;
      font-size: 16px;
    }
    .navbar-dark .navbar-nav .nav-link:hover {
      background-color: #0056b3;
      border-radius: 5px;
    }
    .search-box {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .search-box input {
      padding: 10px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      flex: 1;
      margin-right: 10px;
    }
    .search-box button {
      background-color: #808080;
      color: white;
      border: none;
      border-radius: 15px;
      padding: 10px 20px;
      cursor: pointer;
    }
    .search-box button:hover {
      background-color: #0056b3;
    }
    .bg-primary-custom {
      background-color: #ffffff;
      color: Black;
      padding: 20px;
    }
    .text-primary-custom {
      color: #343a40;
    }
    .card-img-top {
      object-fit: cover;
      height: 200px;
    }
    .card {
      border: none;
      border-radius: 30px;
      overflow: hidden;
      transition: transform 0.2s ease;
      height: 100%;
    }
    .card:hover {
      transform: scale(1.10);
    }
    .card-body {
      padding: 15px;
    }
    .btn-primary-custom {
      background-color: #808080;
      border: none;
      border-radius: 15px;
    }
    .btn-primary-custom:hover {
      background-color: #0056b3;
    }
    .btn-info-custom {
      background-color: #c0c0c0;
      border: none;
    }
    .btn-info-custom:hover {
      background-color: #138496;
    }
    .footer {
      background-color: #ffffff;
      color: red;
      padding: 20px 0;
      text-align: center;
    }
    .footer a {
      color: #b22222;
      text-decoration: none;
    }
    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{ url('/') }}">Rahaman Readers Hub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout ({{ Auth::user()->name }})
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
  </nav>

  <div class="bg-primary-custom text-center">
    <h2>Welcome to Rahaman Readers Hub</h2>
  </div>

  <div class="container mt-4">
    <div class="search-box">
      <input type="text" class="form-control" placeholder="Search for books...">
      <button class="btn btn-primary">
        <i class="fas fa-search"></i> Search
      </button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="text-primary-custom">Books Available</h1>
      @auth
      <a href="{{ route('books.create') }}" class="btn btn-primary-custom">Add Book</a>
      @endauth
    </div>

    <div class="row">
      @foreach ($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="card">
            @if ($book->cover_art)
              <img src="{{ asset($book->cover_art) }}" class="card-img-top" alt="Cover art of {{ $book->title }}">
            @else
              <img src="https://via.placeholder.com/200x300?text=No+Image" class="card-img-top" alt="No cover art available">
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $book->title }}</h5>
              <p class="card-text">
                <strong>Author:</strong> {{ $book->authors }}<br>
                <strong>ISBN:</strong> {{ $book->isbn }}<br>
                <strong>Publisher:</strong> {{ $book->publisher }}<br>
                <strong>Edition:</strong> {{ $book->edition }}<br>
                <strong>Category:</strong> {{ $book->category->name }}
              </p>
              <a href="{{ route('books.show', $book->id) }}" class="btn btn-info-custom mt-auto">View Details</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <footer class="footer">
    <p>&copy; 2024 Rahaman Readers Hub. All rights reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
