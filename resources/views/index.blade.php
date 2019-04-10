<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Books</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
</head>
<body>
    <div class="container">
        <h2> Online Retailer for Technology Books</h2>

        <div class="card">
            <div class="card-header">Books</div>
            <div class="card-body">
                @if(!empty($books))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author->name }}</td>
                                    <td>{{ implode(", ", $book->categories->pluck('name')->toArray()) }}</td>
                                    <td>{{ $book->price }} GBP</td>
                                </tr>
                            @endforeach
                            </tbody>
                            
                        </table>                        
                    </div>
                @else
                    <p>There are no books to display.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>