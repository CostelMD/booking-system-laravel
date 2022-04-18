<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index($id)
    {
        $book = Book::findOrFail($id);
        return $book;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $genres = Genre::all();
        return view('admin.books.add-page', compact('genres'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $lastValue = Book::latest()->first();

        if ($lastValue) {
            $book->id = $lastValue->id + 1;
        }
        $book->id = 1;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->released_at = $request->released_at;
        $book->pages = $request->pages;
        $book->isbn = $request->isbn;
        $book->language_code = $request->language_code;
        $book->in_stock  = $request->in_stock;

        $genres = Genre::find($request->genres);
        $book->genres()->sync($genres);

        $book->save();
        return  redirect('/book/' . $book->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBookPage($id)
    {
        $book = Book::with('genres')->findOrFail($id);
        return view('admin.books.book-page', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  $book = new Book;
        $book = Book::with('genres')->findOrFail($id);
        $book->genres = $book->genres->toArray();
        $genres = Genre::all();

        return view('admin.books.edit-page', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->released_at = $request->released_at;
        $book->pages = $request->pages;
        $book->isbn = $request->isbn;
        $book->language_code = $request->language_code;
        $book->in_stock  = $request->in_stock;

        $genres = Genre::find($request->genres);
        $book->genres()->sync($genres);

        $book->save();
        return  redirect('/book/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book) {
            $book->delete();
        }
        return redirect('dashboard');
    }

    public function showBooksTablePage(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $books = Book::sortable()
                ->where('title', 'like', '%' . $filter . '%')->orWhere('author', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $books = Book::sortable()
                ->paginate(10);
        }


        return view('admin.books.index', compact('books', 'filter'));
    }
}
