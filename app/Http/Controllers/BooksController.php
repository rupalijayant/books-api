<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookFullResource;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /*
	* Create new book
	* @param Request $request
	* @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    */
    public function create(Request $request)
    {
        // validate inputs
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|unique:books|isbn',
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
        ], [
            'isbn.isbn' => 'Invalid ISBN'
        ]);
        // Check if valid
        if ($validator->passes()) {
            // yes valid process the data

            // check if Author exist or create new
            $author = Author::firstOrCreate(['name' => $request->input('author')]);

            // if Categories exist else create new
            $categories = array();
            $postCategories = array_map('trim', explode(',', $request->input('category')));
            foreach ($postCategories as $category) {
                $categories[] = Category::firstOrCreate(['name' => $category]);
            }

            // save the book
            $bookObj = new Book();
            $bookObj->fill([
                'isbn' => $request->input('isbn'),
                'title' => $request->input('title'),
                'price' => $request->input('price'),
            ]);
            $bookObj->author()->associate($author);
            
            $bookObj->save();

            // now save assign categories to book
            foreach ($categories as $category) {
                $bookObj->categories()->attach($category->id);
            }
            // Return the Book all fields with 201 response
            return Response::json(new BookFullResource($bookObj), 201);
        } else {
            // Failed. Return 400 Bad Request.
            return Response::json($validator->errors(), 400);
        }
    }
    /*
    * Retrieve books all, by category, by author
    * @param Request $request
    * @param Book Model
    * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    */
    public function index(Request $request, Book $book)
    {
        // check if author ir category is set
        $author = $request->input('author');
        $category = $request->input('category');

        if (!empty($author) && !empty($category)) {
            // fetch books by Author and Category
            $books = $book->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', "$author");
            })->whereHas('categories', function ($query) use ($category) {
                $query->where('name', 'like', "$category");
            })->get();
        } else if (!empty($author)) {
            // fetch books by author.
            $books = $book->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', "$author");
            })->get();
        } else if (!empty($category)) {
            // fetch books by category.
            $books = $book->whereHas('categories', function ($query) use ($category) {
                $query->where('name', 'like', "$category");
            })->get();
        } else {
            // return all of the books.
            $books = $book->all();
        }
        $booksIsbn = BookResource::collection($books);

        if ($booksIsbn->count() > 0) {
            $response = $booksIsbn;
            $code = '200';
        } else {
            // if no books in specified filters
            $response = 'Sorry!! No books for this search.';
            $code = '202';
        }
        return Response::json($response, $code);
    }
}
