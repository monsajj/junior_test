@extends('layouts.index')

@section('content')
    <div class="title m-b-md">
        Junior Test
    </div>

    <div class="links">
        <a href="{{route('files.show')}}">Files</a>
        <a href="{{route('books.list', ['from' => 'admin'])}}">Books(OOP)</a>
        <a href="{{route('luhn.show')}}">Luhn</a>
    </div>
@endsection
