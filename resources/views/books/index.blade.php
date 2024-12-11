@extends('layouts.main')

@section('container')
<div class="filter mb-3">
    <form method="GET" action="{{ route('books.index') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="limit">Tampilkan:</label>
                <select name="limit" id="limit" class="form-select" onchange="this.form.submit()">
                    <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('limit') == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ request('limit') == 30 ? 'selected' : '' }}>30</option>
                    <option value="40" {{ request('limit') == 40 ? 'selected' : '' }}>40</option>
                    <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                    <option value="60" {{ request('limit') == 60 ? 'selected' : '' }}>60</option>
                    <option value="70" {{ request('limit') == 70 ? 'selected' : '' }}>70</option>
                    <option value="80" {{ request('limit') == 80 ? 'selected' : '' }}>80</option>
                    <option value="90" {{ request('limit') == 90 ? 'selected' : '' }}>90</option>
                    <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="search">Cari:</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Nama Buku atau Penulis">
            </div>
            <div class="col-md-4">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">Cari</button>
            </div>
        </div>
    </form>
</div>

<table class="table table-bordered mt-3">
    <thead class="table-dark">
        <tr>
            <td>No</td>
            <td>Book Name</td>
            <td>Category Name</td>
            <td>Author Name</td>
            <td>Average Rating</td>
            <td>Voter</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $index => $b)
            <tr>
                <td>{{ $books->firstItem() + $index }}</td> <!-- Menghitung nomor urut yang benar -->
                <td>{{ $b->name }}</td> 
                <td>{{ $b->category->name }}</td> 
                <td>{{ $b->author->name }}</td> 
                <td>{{ $b->average_rating }}</td>
                <td>{{ $b->voter }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Menampilkan navigasi halaman -->
<div class="mt-3">
    {{ $books->appends(request()->input())->links() }} <!-- Menyertakan query string saat menampilkan tautan navigasi -->
</div>
@endsection
