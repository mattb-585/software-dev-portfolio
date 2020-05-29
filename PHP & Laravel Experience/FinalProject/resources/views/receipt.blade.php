@extends('layout.master')

@section('content')
<h1>Store - Receipt</h1>

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

<div class="row">
    <div class="col-md-6">
        <h4>Billing Information</h4>
        <p>Name: {{$userBillingInfo['firstName']}} {{$userBillingInfo['lastName']}}</p>
        <p>Address #1: {{$userBillingInfo['address']}}</p>
        @if ($userBillingInfo['addressTwo'] !== null)
            <p>Address #2: {{$userBillingInfo['addressTwo']}}</p>
        @endif
        <p>City: {{$userBillingInfo['city']}}</p>
        <p>State: {{$userBillingInfo['state']}}</p>
        <p>Zip: {{$userBillingInfo['zip']}}</p>
        <p>Phone: {{$userBillingInfo['phone']}}</p>
        <p>Email: {{$userBillingInfo['email']}}</p>          
    </div>
        <div class="col-md-6">
            <h4>Shipping Information</h4>
            <p>Name: {{$userShippingInfo['firstName']}} {{$userShippingInfo['lastName']}}</p>
            <p>Address #1: {{$userShippingInfo['address']}}</p>
            @if ($userShippingInfo['addressTwo'] !== null)
                <p>Address #2: {{$userShippingInfo['addressTwo']}}</p>
            @endif
            <p>City: {{$userShippingInfo['city']}}</p>
            <p>State: {{$userShippingInfo['state']}}</p>
            <p>Zip: {{$userShippingInfo['zip']}}</p>
            <p>Phone: {{$userShippingInfo['phone']}}</p>
            <p>Email: {{$userShippingInfo['email']}}</p>
        </div>
</div>

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
                <td>{{$purchase['quantity']}}</td>
                <td>${{$purchase['productTotal']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="text-right">
    <h6>Subtotal: ${{$userPayment['subtotal']}}</h6>
    <h6 class="mt-2">Shipping &amp; Handling: ${{$userPayment['shippingCost']}}</h6>
    <h6 class="mt-2 text">Total: ${{$userPayment['total']}}</h6>
</div>

<div>
    <h4>Payment</h4>
    <div class="row mb-3">
        <div class="col-md-5">
            <h6 class="mt-2">Card Type: {{$userPayment['cardType']}}</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3">
            <h6 class="mt-2">Card Number: {{$censoredCardNumber}}</h6>
        </div>
        <div class="col-md-3">
            <h6 class="mt-2">Expiration Month: {{$userPayment['expirationMonth']}}</h6>
        </div>
        <div class="col-md-3">
            <h6 class="mt-2">Expiration Year: {{$userPayment['expirationYear']}}</h6>
        </div>
    </div>
    @if ($userShippingInfo['comments'] != null)
        <div>
            <h6 class="mt-2">Comments: {{$userShippingInfo['comments']}}</h6>
        </div>   
    @endif
    <div class="text-right mb-3">
        <a href="{{route('home')}}" class="btn btn-primary">Home Page</a>
    </div>
</div>

@endsection