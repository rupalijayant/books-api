<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookFullResource;
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
            'price' => 'required',
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
}
