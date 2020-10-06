@extends('layouts.index')

@section('links')
    @if($from == 'admin')
        <a href="{{ route('books.list', ['from' => 'user']) }}">User</a>
    @else
        <a href="{{ route('books.list', ['from' => 'admin']) }}">Admin</a>
    @endif
    <a href="{{ route('home') }}">Home</a>
@endsection

@section('content')
    <h1>via {{$from}}</h1>
    <div>
        <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('books.store', ['from' => $from]) }}" class="" autocomplete="off" onsubmit="sendButton.disabled = true; sendButton.innerText = 'WAIT...'; return true;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">New book title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @error('title')
                {{$message}}
                @enderror
            </div>
            <div class="form-group text-center">
                <button name="sendButton" type="submit" class="btn btn-xs btn-default btn-orange btn-success">
                    Add Book
                </button>
            </div>
        </form>
    </div>

    @if (isset($books))
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                @if($from == 'admin')
                    <th>Status</th>
                @endif
                <th>Buttons</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <th scope="row">{{$book['id']}}</th>
                    <td>{{$book['title']}}</td>
                    @if($from == 'admin')
                        <td>{{$book['status']}}</td>
                    @endif
                    <td><a href="{{route('books.show', ['from' => $from, 'id' => $book->id])}}">Show</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
