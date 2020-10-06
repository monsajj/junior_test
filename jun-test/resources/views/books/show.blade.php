@extends('layouts.index')

@section('links')
    @if($from != 'admin')
        <a href="{{ route('books.list', ['from' => 'user']) }}">Book List</a>
    @else
        <a href="{{ route('books.list', ['from' => 'admin']) }}">Book List</a>
    @endif
    <a href="{{ route('home') }}">Home</a>
@endsection

@section('content')
    @if (isset($book))
        <h3> Book "{{$book->title}}" via {{$from}}</h3>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                @if($from == 'admin')
                    <th>Status</th>
                @endif
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$book['id']}}</th>
                <td>{{$book['title']}}</td>
                @if($from == 'admin')
                    <td>{{$book['status']}}</td>
                @endif
            </tr>
            </tbody>
        </table>
    @endif

    @if ($from == 'admin')
        <div>
            <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('books.change.status', ['id' => $book->id]) }}" class="" autocomplete="off" onsubmit="sendButton.disabled = true; sendButton.innerText = 'WAIT...'; return true;">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="status">Book new status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="0">New</option>
                        <option value="1">Published</option>
                        <option value="2">Blocked</option>
                        <option value="3">Deleted</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <button name="sendButton" type="submit" class="btn btn-xs btn-default btn-orange btn-success">
                        Change Status
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection
