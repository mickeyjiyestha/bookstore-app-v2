@extends('layouts.main')

@section('container')
<div class="container mt-5">

    <form action="{{ route('rating.index') }}" method="GET">
        @csrf
        <div class="mb-3">
            <label for="author" class="form-label">Book Author:</label>
            <select name="author_id" id="author" class="form-select" required onchange="this.form.submit()">
                <option value="">Select Author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
    </form>

    @if (request('author_id'))
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="book" class="form-label">Book Name:</label>
                <select name="book_id" id="book" class="form-select" required>
                    <option value="">Select Book</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="">Select Rating</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
</div>
@endsection
