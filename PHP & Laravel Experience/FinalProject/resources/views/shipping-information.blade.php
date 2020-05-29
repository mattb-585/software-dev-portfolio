@extends('layout.master')

@section('content')
<h1>Store - Shipping & Billing</h1>

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

<div>
    <form method="GET" action="{{'shipping-add'}}" class="form">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Billing Information</h4>
                <div class="d-flex flex-row billingText">
                    <label for="billingFirstName" class="billingLabel">First Name:</label>
                    <input type="text" name="billingFirstName" id="billingFirstName" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->firstName : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingLastName" class="billingLabel">Last Name:</label>
                    <input type="text" name="billingLastName" id="billingLastName" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->lastName : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingAddress" class="billingLabel">Address:</label>
                    <input type="text" name="billingAddress" id="billingAddress" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->address : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingAddressTwo" class="billingLabel">Address Two:</label>
                    <input type="text" name="billingAddressTwo" id="billingAddressTwo" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->addressTwo : ''}}">
                </div> 
                <div class="d-flex flex-row billingText">
                    <label for="billingCity" class="billingLabel">City:</label>
                    <input type="text" name="billingCity" id="billingCity" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->city : ''}}">
                </div> 
                {{-- <div class="d-flex flex-row billingText">
                    <label for="billingState" class="billingLabel">State:</label>
                    <input type="text" name="billingState" id="billingState" class="textboxWidth ml-auto" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->state : ''}}">
                </div>  --}}
                <div class="d-flex flex-row">
                    <label for="billingState" class="billingLabel">State:</label>
                    <select name="billingState" id="billingState" class="textboxWidth ml-auto mb-2 form-control">
                        @foreach ($states as $state)
                            <option value={{$state}}>{{$state}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingZip" class="billingLabel">Zip:</label>
                    <input type="text" name="billingZip" id="billingZip" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->zip : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingPhone" class="billingLabel">Phone:</label>
                    <input type="text" name="billingPhone" id="billingPhone" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->phone : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingEmail" class="billingLabel">Email:</label>
                    <input type="text" name="billingEmail" id="billingEmail" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->email : ''}}">
                </div>           
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Shipping Information</h4>
                <div class="d-flex flex-row form-check ml-5 mb-2">
                    <label for="sameAsBilling" class="form-check-label">Same as Billing</label>
                    <input type="checkbox" name="sameAsBilling" id="sameAsBilling" class="form-check-input">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingFirstName" class="billingLabel">First Name:</label>
                    <input type="text" name="shippingFirstName" id="shippingFirstName" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->firstName : ''}}">
                </div>
                    <div class="d-flex flex-row billingText">
                    <label for="shippingLastName" class="billingLabel">Last Name:</label>
                    <input type="text" name="shippingLastName" id="shippingLastName" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->lastName : ''}}">
                </div>
                    <div class="d-flex flex-row billingText">
                    <label for="shippingAddress" class="billingLabel">Address:</label>
                    <input type="text" name="shippingAddress" id="shippingAddress" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->address : ''}}">
                </div>
                    <div class="d-flex flex-row billingText">
                    <label for="shippingAddressTwo" class="billingLabel">Address Two:</label>
                    <input type="text" name="shippingAddressTwo" id="shippingAddressTwo" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->addressTwo : ''}}">
                </div> 
                    <div class="d-flex flex-row billingText">
                    <label for="shippingCity" class="billingLabel">City:</label>
                    <input type="text" name="shippingCity" id="shippingCity" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->city : ''}}">
                </div> 
                <div class="d-flex flex-row">
                    <label for="shippingState" class="billingLabel">State:</label>
                    <select name="shippingState" id="shippingState" class="textboxWidth ml-auto mb-2 form-control">
                        @foreach ($states as $state)
                            <option value={{$state}}>{{$state}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingZip" class="billingLabel">Zip:</label>
                    <input type="text" name="shippingZip" id="shippingZip" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->zip : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingPhone" class="billingLabel">Phone:</label>
                    <input type="text" name="shippingPhone" id="shippingPhone" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->phone : ''}}">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingEmail" class="billingLabel">Email:</label>
                    <input type="text" name="shippingEmail" id="shippingEmail" class="textboxWidth ml-auto form-control" value="{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->email : ''}}">
                </div>
            </div>
        </div>
        <div>
            <h4>Comments</h4>
            <textarea name="commentsInput" id="commentsInput" cols="100" rows="5" class="form-control">{{ url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->comments : ''}}</textarea>
        </div>
        {{ csrf_field() }}
        <div class="text-right mt-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            <input type="submit" value="Next" class="btn btn-primary">
        </div>
    </form>
</div>


@endsection