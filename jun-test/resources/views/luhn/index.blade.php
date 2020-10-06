@extends('layouts.index')

@section('links')
    <a href="{{ route('home') }}">Home</a>
@endsection

@section('content')
    <div class="form-group">
        <label for="number">Number</label>
        <input type="text" class="form-control" id="number" name="number">
        <label id="valid"></label>
    </div>
    <div class="form-group text-center">
        <button id="checkButton" name="checkButton" type="button" class="btn btn-xs btn-default btn-orange btn-success">
            Check Number
        </button>
    </div>

    @if (isset($numbers))
        <table class="table">
            <thead>
            <tr>
                <th>Number</th>
                <th>Is Valid</th>
            </tr>
            </thead>
            <tbody>
            @foreach($numbers as $number)
                <tr>
                    <td>{{$number['number']}}</td>
                    <td>{{$number['valid']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('script')
    <script>
        $('#checkButton').on('click', function () {
            let number = document.getElementById('number').value
            jQuery.ajax({
                type: "POST",
                url: "{{route('luhn.check')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    number: number
                },
                error: function(data) {
                    document.getElementById('valid').innerHTML = JSON.parse(data.responseText).errors.number[0];
                }
            }).then(function (data) {
                numberValid = data.isValid
                if (numberValid) {
                    document.getElementById('valid').innerHTML = 'valid';
                }
                else {
                    document.getElementById('valid').innerHTML = 'not valid';
                }
            })
        })
    </script>
@endsection
