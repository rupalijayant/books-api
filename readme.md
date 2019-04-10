<p align="center">
	Online Retailer API for Technology Books
</p>

## About API Usage

Create a book
- - **[<code>POST</code> http://books-api.test/api/v1/books/create]**

	Post variables
	isbn => valid ISBN-10 e.g. 978-9087654321
	title => Book Title
	author => Name of Author for this book
	category => Categories of this book (one or more)
	price => price of book in GBP


Fetch all books
- - **[<code>GET</code> http://books-api.test/api/v1/books/]**


Fetch books by author
- - **[<code>GET</code> http://books-api.test/api/v1/books/?author=Robin Nixon]**


Fetch books by category
- - **[<code>GET</code> http://books-api.test/api/v1/books/?category=Linux]**


Fetch books by author and category
- - **[<code>GET</code> http://books-api.test/api/v1/books/?author=Robin Nixon&category=Linux]**