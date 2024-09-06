<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index($bookId)
    {
        // Fetch the book with its comments
        $book = Book::with('comments.user')->findOrFail($bookId);

        // Pass the book and its comments to the view
        return view('comments.index', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->book_id = $bookId;
        $comment->user_id = Auth::id();
        $comment->save();

        // Redirect to the comment list after adding a comment
        return redirect()->route('comments.index', $bookId)->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($bookId)
    {
        $book = Book::with('comments.user')->findOrFail($bookId);

        return view('comments.show', compact('book'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
    
        if (Gate::denies('delete-comment')) {
            abort(403, 'Unauthorized action.');
        }
    
        $comment->delete();
    
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
