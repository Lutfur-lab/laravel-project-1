<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} Details</title>
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
        .btn-danger {
            background-color: #ff5e57;
            border-color: #ff5e57;
        }
        .btn-danger:hover {
            background-color: #d9534f;
            border-color: #d9534f;
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
            width: 50%;
            height: auto;
            max-width: 10px;
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ced4da;
            margin-bottom: 20px;
            font-size: 16px;
        }
        footer {
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

    <!-- Buttons Section -->
    <div class="container text-right mb-4">
        <a href="{{ route('books.create') }}" class="btn btn-custom btn-primary"><i class="fas fa-plus"></i> Add Book</a>
        <a href="{{ route('categories.index') }}" class="btn btn-custom btn-secondary"><i class="fas fa-list"></i> Categories</a>
    </div>

    <!-- Book Details -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>{{ $book->title }}</h1>
                @if($book->cover_art)
                    <img src="{{ asset($book->cover_art) }}" alt="{{ $book->title }}" class="img-fluid">
                @endif
                <div class="mt-4">
                    <p><strong>Authors:</strong> {{ $book->authors }}</p>
                    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
                    <p><strong>Edition:</strong> {{ $book->edition }}</p>
                    <p><strong>Category:</strong> {{ $book->category->name }}</p>
                    <p><strong>Added by:</strong> {{ $book->user->name }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-custom btn-warning"><i class="fas fa-edit"></i> Edit Book</a>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-5">
                    <h2>Comments</h2>
                    @if ($book->comments->isEmpty())
                        <p class="text-center">No comments yet.</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($book->comments as $comment)
                                <li class="mb-3">
                                    <strong>{{ $comment->user->name }}</strong> said: {{ $comment->content }}
                                    <br>
                                    <small>Posted on {{ $comment->created_at->format('d M Y, H:i') }}</small>
                                    @can('delete-comment', $comment)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-custom"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </form>
                                    @endcan
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Add a Comment -->
                @auth
                <div class="add-comment mt-5">
                    <h3 class="text-center">Add a Comment</h3>
                    <form action="{{ route('comments.store', $book->id) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="4" required placeholder="Write your comment here..."></textarea>
                        <button type="submit" class="btn btn-success btn-custom"><i class="fas fa-comment"></i> Add Comment</button>
                    </form>
                </div>
                @else
                <div class="add-comment mt-5 text-center">
                    <h3 class="text-center">You need to <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to add a comment.</h3>
                </div>
                @endauth

                <!-- Manage Book Options -->
                @can('manage-book', $book)
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');" class="text-center mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-custom"><i class="fas fa-trash-alt"></i> Delete Book</button>
                </form>
                @endcan

                <!-- Navigation Links -->
                <div class="mt-5 text-center">
                    <a href="{{ url('/books') }}" class="btn btn-info btn-custom"><i class="fas fa-arrow-left"></i> Back to Books List</a>
                    <a href="{{ route('comments.show', $book->id) }}" class="btn btn-secondary btn-custom"><i class="fas fa-comments"></i> View All Comments</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Rahaman Readers Club. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
