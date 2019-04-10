<p align="center">
	Online Retailer API (Rest JSON) for Technology Books
</p>

## About API Usage

Create a book
- - **[<code>POST</code> http://books-api.test/api/v1/books/create]**

	Post variables
	| Parameter | Type | Description |
	| :--- | :--- | :--- |
	| `isbn` | `string` | **Required**. valid ISBN-10 e.g. 978-9087654321 |
	| `title` | `string` | **Required**. Title of the Book |
	| `author` | `string` | **Required**. Author of the Book |
	| `category` | `string` | **Required**. Categories of this Book (one or more) |
	| `price` | `string` | **Required**. price of book in GBP e.g - 18.99 |
	

Fetch all books
- - **[<code>GET</code> http://books-api.test/api/v1/books/]**


Fetch books by author
- - **[<code>GET</code> http://books-api.test/api/v1/books/?author=Robin Nixon]**


Fetch books by category
- - **[<code>GET</code> http://books-api.test/api/v1/books/?category=Linux]**


Fetch books by author and category
- - **[<code>GET</code> http://books-api.test/api/v1/books/?author=Robin Nixon&category=Linux]**