@extends('layouts.logged')

@section('content')

    <div class="jumbotron">
        <h2 class="text-center">Your completed orders</h2>    
    </div>

    <table>
        <tbody>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Description</th>
            <th>Price (ZAR)</th>
        </tbody>
        @foreach($products as $product)
        <tr>
        
            <td> {{ $product->title }}</td>
            <td><img src="{{ $product->image }}" alt="{{ $product->title }}"></td>
            <td>{{ $product->description }}</td>
            <td><strong>{{ $product->price }}</strong></td>
        
        </tr>
        @endforeach
    </table
@endsection
