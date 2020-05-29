@extends('layout.master')

@section('content')
<h1>Store - Preview Order</h1>

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
    <form method="GET" action="preview">
        <h6>Subtotal: ${{$subtotal}}</h6>
        <label for="priorityInput">Shipping Options:</label>
        <select name="priorityInput" class="form-control" id="priorityInput">
            <option value="0.00" >U.S.P.S Free (4-5 days)</option>
            <option value="5.99" {{$shippingPriority  == "5.99" ? 'selected' : ''}}>U.S.P.S Priority #1 (Same Day)</option>
            <option value="3.99" {{$shippingPriority  == "3.99" ? 'selected' : ''}}>U.S.P.S Priority #2 (2-3 days)</option>
        </select>
        <h6 class="mt-2">Shipping &amp; Handling: ${{$shippingPriority != null ? $shippingPriority : 0.00}}</h6>
        <h6 class="mt-2 text">Total: ${{$total}}</h6>
        <input type="submit" value="Update Total" class="btn btn-primary">
    </form>
</div>

<div>
    <h4>Payment</h4>
    <form method="GET" action="{{ route('add-payment') }}">
        {{ csrf_field() }}
        <div class="row mb-3">
            <div class="col-md-5">
                <label for="cardTypeInput">Card Type:</label>
                <select name="cardTypeInput" class="form-control" id="cardTypeInput">
                    <option value="Visa" >Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="Discover">Discover</option>
                    <option value="American Express">American Express</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="cardNumberInput">Card Number:</label>
                <input type="text" id="cardNumberInput" name="cardNumberInput" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="expirationMonthInput">Exp Month:</label>
                <select name="expirationMonthInput" class="form-control" id="expirationMonthInput">
                    <option value="January" >January</option>
                    <option value="Febuary">Febuary</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="expirationMonthInput">Exp Year:</label>
                <select name="expirationYearInput" class="form-control" id="expirationYearInput">
                    <option value="2020" >2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>
        </div>
        <div class="text-right mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            <input type="submit" value="Purchase" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection