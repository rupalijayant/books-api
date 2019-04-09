<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Show index page
     *
     * @param $book Book The Book model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Book $book)
    {
        $books = $book->paginate(10);
        return view('index', compact('books'));
    }
}
