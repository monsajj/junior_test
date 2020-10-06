@extends('layouts.index')

@section('links')
    <a href="{{ route('home') }}">Home</a>
@endsection

@section('content')
    <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('files.store') }}" class="" autocomplete="off" onsubmit="sendButton.disabled = true; sendButton.innerText = 'WAIT...'; return true;">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <input name="file" type="hidden" value="csv">
        <div class="form-group">
            <label for="exampleFormControlFile1">Choose File</label>
            <input type="file" class="form-control-file" id="import" name="import" accept=".csv" required>
            @error('import')
            {{$message}}
            @enderror
        </div>
        <div class="form-group text-center">
            <button name="sendButton" type="submit" class="btn btn-xs btn-default btn-orange btn-success">
                IMPORT
            </button>
        </div>
    </form>

    @if (isset($products))
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Article</th>
                <th>Cost</th>
                <th>Price</th>
                <th>Extra charge</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr bgcolor="{{$product['color']}}">
                    <th scope="row">{{$product['id']}}</th>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['article']}}</td>
                    <td>{{$product['cost']}}</td>
                    <td>{{$product['price']}}</td>
                    <td>{{$product['extra-charge']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
