<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::where('user', auth()->id())->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->user = auth()->id();
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

    /**
     * Kitaplar listesindeki kitabın durumunu günceller.
     * @param Book $book
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Book $book, $status)
    {
        if($status == 'want'){
            $book->update(['status' => 'unread']);
        }elseif ($status == 'unread') {
            $book->update(['status' => 'read']);
        }
        return back();
    }
}
