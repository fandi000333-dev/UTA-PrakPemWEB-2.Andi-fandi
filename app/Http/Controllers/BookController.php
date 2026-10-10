<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
{
    $keyword = trim((string) $request->query('q', ''));

    $books = Book::query()
        ->when($keyword !== '', function ($query) use ($keyword): void {
            $query->where(function ($subQuery) use ($keyword): void {
                $subQuery
                    ->where('title', 'like', "%{$keyword}%")
                    ->orWhere('author', 'like', "%{$keyword}%")
                    ->orWhere('isbn', 'like', "%{$keyword}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('books.index', compact('books', 'keyword'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('books.create'); // Pastikan file view-nya ada
}

    /**
     * Store a newly created resource in storage.
     */
  
    public function store(StoreBookRequest $request): RedirectResponse
{
    Book::create($request->validated());

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
   public function show(Book $book): View
{
    return view('books.show-static', compact('book'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
{
    return view('books.edit', compact('book'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(
    UpdateBookRequest $request,
    Book $book
    ): RedirectResponse {
    $book->update($request->validated());

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil diperbarui.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
{
    $book->delete();

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil dihapus.');
}

}