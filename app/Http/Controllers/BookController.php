<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books',
            'authors' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'edition' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover_art' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_art')) {
            $fileName = time() . '.' . $request->file('cover_art')->getClientOriginalExtension();
            $path = $request->file('cover_art')->storeAs('images/books', $fileName, 'public');
            $validated['cover_art'] = '/storage/' . $path;
        }

        $validated['user_id'] = auth()->id();
        Book::create($validated);

        return redirect('/books')->with('success', 'Book added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->authorize('manage-book', $book);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => ['required', 'string', 'max:255', Rule::unique('books')->ignore($book->id)],
            'authors' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'edition' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover_art' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_art')) {
            $fileName = time() . '.' . $request->file('cover_art')->getClientOriginalExtension();
            $path = $request->file('cover_art')->storeAs('images/books', $fileName, 'public');
            $validated['cover_art'] = '/storage/' . $path;
        }

        $book->update($validated);

        return redirect()->route('books.show', $book->id)->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('manage-book', $book);

        // Delete associated comments (if any)
        $book->comments()->delete();

        // Delete the book
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book and its associated records deleted successfully!');
    }
    
    public function dashboard()
    {
        $books = Book::all(); // Fetch all books or apply pagination if needed
        return view('dashboard', compact('books'));
    }

}
