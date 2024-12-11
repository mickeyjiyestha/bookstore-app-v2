@extends('layouts.main')

@section('container')
<table class="table table-bordered mt-3">
    <thead class="table-dark">
        <tr>
            <td>No</td>
            <td>Book Name</td>
            <td>Voter</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($authors as $index => $a)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $a->name }}</td> 
                <td>{{ $a->voter }}</td> 
            </tr>
        @endforeach
    </tbody>
</table>
@endsection