@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Books</h1>

        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>

        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">{{ $book->author }}</p>
                                    <p class="card-text">{{ ucfirst($book->status) }}</p>
                                </div>
                                <div class="col-md-4 d-flex justify-content-end align-items-start">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-primary mr-2">View Details</a>
                                    @if ($book->status == 'unread')
                                        <form method="POST" action="{{ route('books.updateStatus', ['book' => $book, 'status' => $book->status]) }}" class="d-inline-block mr-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Mark as Read</button>
                                        </form>
                                    @elseif($book->status == 'want')
                                        <form method="POST" action="{{ route('books.updateStatus', ['book' => $book, 'status' => $book->status]) }}" class="d-inline-block mr-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Mark as Unread</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
