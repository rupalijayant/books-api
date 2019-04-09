<?php

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //lets add some books in table as default
        $books = array(
        	array(
                'isbn' => '978-1491918661',
                'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
                'author' => 'Robin Nixon',
                'categories' => ['PHP', 'Javascript'],
                'price' => 9.99,
            ),
            array(
                'isbn' => '978-0596804848',
                'title' => "Ubuntu: Up and Running: A Power User's Desktop Guide",
                'author' => 'Robin Nixon',
                'categories' => ['Linux'],
                'price' => 12.99,
            ),
            array(
                'isbn' => '978-1118999875',
                'title' => 'Linux Bible',
                'author' => 'Christopher Negus',
                'categories' => ['Linux'],
                'price' => 19.99,
            ),
            array(
                'isbn' => '978-0596517748',
                'title' => 'JavaScript: The Good Parts',
                'author' => 'Douglas Crockford',
                'categories' => ['JavaScript'],
                'price' => 8.99,
            )
        );

        // now lets go through each one and add them to database with author and category in their table
        foreach ($books as $book) {
        	// lets check if author exists, get id or create author with this name
        	$author = Author::firstOrCreate(['name' => $book['author']]);

        	// lets check categories exists or not else create new
        	$categories = [];

        	foreach ($book['categories'] as $category) {
        		$categories[] = Category::firstOrCreate(['name' => $category]);
        	}

        	// now lets remove author and categories
        	unset($book['author']);
        	unset($book['categories']);

        	// create book obj and save this book
        	$bookObj = new Book();
            $bookObj->fill($book);
            $bookObj->author()->associate($author);
            
            $bookObj->save();

            // attach categories to this books 
            foreach ($categories as $category) {
                $bookObj->categories()->attach($category->id);
            }
        }
    }
}
