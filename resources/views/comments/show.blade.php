<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments for {{ $book->title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #34495e;
            font-size: 28px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 22px;
            color: #2980b9;
            margin-bottom: 15px;
        }
        form {
            margin-bottom: 30px;
        }
        textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 15px;
            transition: border-color 0.3s ease;
        }
        textarea:focus {
            border-color: #3498db;
        }
        button {
            padding: 12px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #ecf0f1;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        small {
            color: #7f8c8d;
        }
        .delete-btn {
            background-color: #e74c3c;
            border-radius: 8px;
            padding: 6px 10px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            position: absolute;
            right: 15px;
            top: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        a {
            color: #3498db;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .alert-success {
            background-color: #2ecc71;
            color: #fff;
        }
        .alert-danger {
            background-color: #e74c3c;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Comments for {{ $book->title }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>Add a Comment</h2>
        <form action="{{ route('comments.store', $book->id) }}" method="POST">
            @csrf
            <textarea name="content" rows="4" required placeholder="Write your comment here..."></textarea>
            <button type="submit">Add Comment</button>
        </form>

        <h2>Comments</h2>
        <ul>
            @foreach($book->comments as $comment)
                <li>
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                    <br>
                    <small>Posted on {{ $comment->created_at->format('d M Y, H:i') }}</small>

                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    @endcan
                </li>
            @endforeach
        </ul>

        <a href="{{ route('books.index') }}">Back to Books List</a>
        <a href="{{ route('books.show', $book->id) }}">Back to the Book</a>
    </div>

</body>
</html>
