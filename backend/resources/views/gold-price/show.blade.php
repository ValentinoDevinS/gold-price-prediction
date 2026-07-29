@extends('layouts.app')

@section('title', 'Gold Price')

@section('content')

<div class="container">

    <h1>Gold Price Detail</h1>

    @if($goldPrice)

        <table class="table">

            <tr>
                <th>Date</th>
                <td>{{ $goldPrice->priceDate }}</td>
            </tr>

            <tr>
                <th>Open</th>
                <td>{{ $goldPrice->openPrice }}</td>
            </tr>

            <tr>
                <th>High</th>
                <td>{{ $goldPrice->highPrice }}</td>
            </tr>

            <tr>
                <th>Low</th>
                <td>{{ $goldPrice->lowPrice }}</td>
            </tr>

            <tr>
                <th>Close</th>
                <td>{{ $goldPrice->closePrice }}</td>
            </tr>

            <tr>
                <th>Volume</th>
                <td>{{ number_format($goldPrice->volume) }}</td>
            </tr>

        </table>

    @else

        <div class="alert alert-warning">
            Gold price not found.
        </div>

    @endif

</div>

@endsection