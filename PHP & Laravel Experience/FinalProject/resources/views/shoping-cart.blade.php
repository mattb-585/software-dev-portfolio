@extends('layout.master')

@section('content')
<h1>Store - Cart</h1>

@if(Session::has('info'))
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-info">{{Session::get('info')}}</p>
    </div>
</div>
@endif

@if (count($errors->all()))
  <div class="row">
      <div class="col-md-12">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
      </div>
  </div>
@endif

<table class="table table-light table-bordered">
    <thead>
        <th>Product Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Product Price</th>
    </thead>

    <tbody>
        @foreach ($purchases as $purchase)
            <tr>
                <td>{{$purchase['productDescription']}}</td>
                <td>${{$purchase['price']}}</td>
                <td>
                    <form method="GET" action="{{route('cart-edit', [ 'id' => $purchase['id'] ])}}">
                        <label for="updateInput"></label>
                        <input type="text" value="{{$purchase['quantity']}}" id="updateInput" name="updateInput">
                        {{-- <a href="{{ route('cart-edit', [ 'id' => $purchase['id'] ]) }}" class="btn btn-primary">Update</a> --}}
                        <input type="submit" value="Update Quantity" class="btn btn-primary">
                    </form>
                </td>
                <td>${{$purchase['productTotal']}}</td>
                <td>
                    {{ csrf_field() }}
                    <input type="hidden" name="hiddenId" value="{{$purchase['id']}}">
                    <a href="{{ route('cart-delete', [ 'id' => $purchase['id'] ]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="text-right">
      <h6>Subtotal: ${{$subtotal}}</h6>
</div>

<div class="text-right">
    <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
    <a href="{{ route('shipping') }}" class="btn btn-primary">Next</a>
</div>


@endsection