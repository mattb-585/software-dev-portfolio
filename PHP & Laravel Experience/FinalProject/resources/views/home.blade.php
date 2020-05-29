@extends('layout.master')

@section('content')
<h1>Store</h1>

@if(Session::has('info'))
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-info">{{Session::get('info')}}</p>
    </div>
</div>
@endif

@if (count($errors->all()))
  <div class="d-inline-block mt-3 alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
      </ul>
  </div>
@endif

<ul class="nav flex-column text-right border-right" id="side-nav">
    <h6 class="navbar-brand">Categories</h6>
    <li class="nav-item">
      <a class="nav-link active" href="{{route('clothing')}}">Clothing</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('mugs')}}">Mugs</a>
    </li>
</ul>

<div class="row row-cols-1 row-cols-md-3">
  @foreach ($products as $product)
    <div class="col mb-4">
      <div class="card">
          <img src={{asset('img/' . $product['image'])}} class="card-img-top" alt="placeholder">
          <div class="card-body text-center">
            <h5 class="card-title">{{$product['name']}}</h5>
            <p>${{strval($prices->where('product_id', $product['id'])->last()->price)}}</p>
            <form method="POST" action="{{route('store-post')}}">
              @if ( strpos($product['name'], 'Shirt') == true )
              <label for="sizeInput">Size:</label>
              <select name="sizeInput" class="form-control" id="sizeInput">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="X-Large">X-Large</option>
              </select>
                  <br>
              @endif
              <label for="quantityInput">Quantity:</label>
              <input type="text" id="quantityInput" name="quantityInput">
              <br>
              {{ csrf_field() }}
              <input type="hidden" name="hiddenId" value="{{$product['id']}}">
              <input type="submit" class="btn btn-primary" value="Add To Cart">
            </form>
          </div>
      </div>
    </div>
  @endforeach
</div>

@endsection