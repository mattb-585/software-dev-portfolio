<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Price;
use App\Purchase;
use App\BillingAddress;
use App\ShippingAddress;
use App\Payment;

class StoreController extends Controller
{
    public function getHomePage() {
        $products = Product::all();
        $prices = Price::all();
        return view('home', compact('products', 'prices'));
    }

    public function getClothing() {
        $products = Product::all();
        $prices = Price::all();
        return view('clothing', compact('products', 'prices'));
    }

    public function getMugs() {
        $products = Product::all();
        $prices = Price::all();
        return view('mugs', compact('products', 'prices'));
    }

    public function postStorePage(Request $request) {
        $this->validate($request, [
            'quantityInput' => 'required|integer|max:99'
        ]);

        $prices = Price::all();
        $product = Product::find($request->input('hiddenId'));
        $currentPrice = strval($prices->where('product_id', $product['id'])->last()->price);
        $quantity = $request->input('quantityInput');
        $totalPrice = $currentPrice + $quantity;
        $size = $request->sizeInput;

        if (strpos($product['name'], 'Shirt') == true) {
            $purchase = new Purchase ([
                'productDescription' => $size . " " . $product['name'],
                'price' => $currentPrice,
                'quantity' => $quantity,
                'productTotal' => $totalPrice
            ]);

            $purchase->save();
        } else {
            $purchase = new Purchase ([
                'productDescription' => $product['name'],
                'price' => $currentPrice,
                'quantity' => $quantity,
                'productTotal' => $totalPrice
            ]);

            $purchase->save();
        }



        return redirect()->back()->with('info', 'Item(s) are now added to your cart! - ' . $product['name']);
    }

    public function getShoppingCart() {
        $purchases = Purchase::all();
        $subtotal = Purchase::all()->sum('productTotal');
        return view('shoping-cart', compact('purchases', 'subtotal'));
    }

    public function deleteShoppingCart($id) {
        $purchase = Purchase::find($id);
        $purchase->delete();

        return redirect()->back()->with('info', 'Item Deleted');
    }

    public function updateShoppingCart(Request $request, $id) {
        $this->validate($request, [
            'updateInput' => 'required|integer|max:99'
        ]);

        $purchase = Purchase::find($id);
        $newQuantity = $request->input('updateInput');
        $currentPrice = $purchase->price;
        $newProductTotal = $newQuantity * $currentPrice;

        $purchase->quantity = $newQuantity;
        $purchase->productTotal = $newProductTotal;
        $purchase->save();

        return redirect()->back()->with('info', 'Item Updated');
    }

    public function getShippingInfo() {
        $userBillingInfo = BillingAddress::all()->last();
        $userShippingInfo = ShippingAddress::all()->last();

        $states = array(
            'Alabama',
            'Alaska',
            'Arizona',
            'Arkansas',
            'California',
            'Colorado',
            'Connecticut',
            'Delaware',
            'Florida',
            'Georgia',
            'Hawaii',
            'Idaho',
            'Illinois',
            'Indiana',
            'Iowa',
            'Kansas',
            'Kentucky',
            'Louisiana',
            'Maine',
            'Maryland',
            'Massachusetts',
            'Michigan',
            'Minnesota',
            'Mississippi',
            'Missouri',
            'Montana',
            'Nebraska',
            'Nevada',
            'New Hampshire ',
            'New Jersey ',
            'New Mexico',
            'New York',
            'North Carolina',
            'North Dakota',
            'Ohio',
            'Oklahoma',
            'Oregon',
            'Pennsylvania',
            'Rhode Island',
            'South Carolina',
            'South Dakota',
            'Tennessee',
            'Texas',
            'Utah',
            'Vermont',
            'Virginia',
            'Washington',
            'West Virginia ',
            'Wisconsin',
            'Wyoming',
        );

        return view('shipping-information', compact('userBillingInfo', 'userShippingInfo', 'states'));
    }

    public function addShippingInfo(Request $request) {
        $subtotal = Purchase::all()->sum('productTotal');

        $newUserPayment = new Payment([
            'shippingCost' => 0.00,
            'subtotal' => $subtotal,
            'total' => $subtotal
        ]);

        $newUserPayment->save();


        $this->validate($request, [
            'billingFirstName' => 'required',
            'billingLastName' => 'required',
            'billingAddress' => 'required',
            'billingCity' => 'required',
            'billingZip' => 'required|integer|min:5',
            'billingPhone' => 'required|min:10|numeric',
            'billingEmail' => 'required|email'
        ]);

        if ($request->has('sameAsBilling') == false) {
            $this->validate($request, [
                'shippingFirstName' => 'required',
                'shippingLastName' => 'required',
                'shippingAddress' => 'required',
                'shippingCity' => 'required',
                'shippingZip' => 'required|integer|min:5',
                'shippingPhone' => 'required|min:10|numeric',
                'shippingEmail' => 'required|email'
            ]);
        }


        $billingInfo = new BillingAddress([
            'firstName' => $request->input('billingFirstName'),
            'lastName' => $request->input('billingLastName'),
            'address' => $request->input('billingAddress'),
            'addressTwo' => $request->input('billingAddressTwo'),
            'city' => $request->input('billingCity'),
            'state' => $request->input('billingState'),
            'zip' => $request->input('billingZip'),
            'phone' => $request->input('billingPhone'),
            'email' => $request->input('billingEmail')
        ]);
        $billingInfo->save();

        if ($request->has('sameAsBilling')) {
            $shippingInfo = new ShippingAddress([
                'firstName' => $request->input('billingFirstName'),
                'lastName' => $request->input('billingLastName'),
                'address' => $request->input('billingAddress'),
                'addressTwo' => $request->input('billingAddressTwo'),
                'city' => $request->input('billingCity'),
                'state' => $request->input('billingState'),
                'zip' => $request->input('billingZip'),
                'phone' => $request->input('billingPhone'),
                'email' => $request->input('billingEmail'),
                'comments' => $request->input('commentsInput'),
            ]);
            $shippingInfo->save();
        } else {
            $shippingInfo = new ShippingAddress([
                'firstName' => $request->input('shippingFirstName'),
                'lastName' => $request->input('shippingLastName'),
                'address' => $request->input('shippingAddress'),
                'addressTwo' => $request->input('shippingAddressTwo'),
                'city' => $request->input('shippingCity'),
                'state' => $request->input('shippingState'),
                'zip' => $request->input('shippingZip'),
                'phone' => $request->input('shippingPhone'),
                'email' => $request->input('shippingEmail')
            ]);
            $shippingInfo->save();
        }
        
        return redirect()->route('preview');
    }

    public function getPreview(Request $request) {
        $userPayment = Payment::all()->last();
        $shippingPriority = $request->priorityInput;
        $subtotal = Purchase::all()->sum('productTotal');

        $userPayment->shippingCost = doubleval($shippingPriority);
        $userPayment->total = $subtotal + doubleval($shippingPriority);
        $userPayment->save();

        $userBillingInfo = BillingAddress::all()->last();
        $userShippingInfo = ShippingAddress::all()->last();
        $purchases = Purchase::all();
        $shippingPriority = $userPayment->shippingCost;
        $total = $userPayment->total;
        return view('preview-order', compact('userBillingInfo', 'userShippingInfo', 'purchases', 'subtotal', 'shippingPriority', 'total'));
    }

    public function addPayment(Request $request) {
        $this->validate($request, [
            'cardNumberInput' => 'required|integer'
        ]);

        $userPayment = Payment::all()->last();

        $userPayment->cardType = $request->cardTypeInput;
        $userPayment->cardNumber = $request->input('cardNumberInput');
        $userPayment->expirationMonth = $request->expirationMonthInput;
        $userPayment->expirationYear = $request->expirationYearInput;

        $userPayment->save();

        return redirect()->route('receipt')->with('info', 'Order has been sent! Thank you for shopping with us!');
    }

    public function getRecipt() {
        $userBillingInfo = BillingAddress::all()->last();
        $userShippingInfo = ShippingAddress::all()->last();
        $purchases = Purchase::all();
        $userPayment = Payment::all()->last();
        $userCardNumber = $userPayment->cardNumber;
        $censoredCardNumber = str_repeat("X", strlen($userCardNumber)-4) . substr($userCardNumber, -4);
        return view('receipt', compact('userBillingInfo', 'userShippingInfo', 'purchases', 'userPayment', 'censoredCardNumber'));
    }
}
