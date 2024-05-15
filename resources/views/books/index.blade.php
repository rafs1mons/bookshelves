@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Books</h1>

        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>

        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author }}</p>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-primary">View Details</a>
                            @if ($book->status == 'unread')
                                <form method="POST" action="{{ route('books.updateStatus', $book) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Mark as Read</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
