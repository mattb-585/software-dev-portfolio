<?php $__env->startSection('content'); ?>
<h1>Store - Receipt</h1>

<?php if(Session::has('info')): ?>
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-info"><?php echo e(Session::get('info')); ?></p>
    </div>
</div>
<?php endif; ?>

<?php if(count($errors->all())): ?>
  <div class="row">
      <div class="col-md-12">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
  </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <h4>Billing Information</h4>
        <p>Name: <?php echo e($userBillingInfo['firstName']); ?> <?php echo e($userBillingInfo['lastName']); ?></p>
        <p>Address #1: <?php echo e($userBillingInfo['address']); ?></p>
        <?php if($userBillingInfo['addressTwo'] !== null): ?>
            <p>Address #2: <?php echo e($userBillingInfo['addressTwo']); ?></p>
        <?php endif; ?>
        <p>City: <?php echo e($userBillingInfo['city']); ?></p>
        <p>State: <?php echo e($userBillingInfo['state']); ?></p>
        <p>Zip: <?php echo e($userBillingInfo['zip']); ?></p>
        <p>Phone: <?php echo e($userBillingInfo['phone']); ?></p>
        <p>Email: <?php echo e($userBillingInfo['email']); ?></p>          
    </div>
        <div class="col-md-6">
            <h4>Shipping Information</h4>
            <p>Name: <?php echo e($userShippingInfo['firstName']); ?> <?php echo e($userShippingInfo['lastName']); ?></p>
            <p>Address #1: <?php echo e($userShippingInfo['address']); ?></p>
            <?php if($userShippingInfo['addressTwo'] !== null): ?>
                <p>Address #2: <?php echo e($userShippingInfo['addressTwo']); ?></p>
            <?php endif; ?>
            <p>City: <?php echo e($userShippingInfo['city']); ?></p>
            <p>State: <?php echo e($userShippingInfo['state']); ?></p>
            <p>Zip: <?php echo e($userShippingInfo['zip']); ?></p>
            <p>Phone: <?php echo e($userShippingInfo['phone']); ?></p>
            <p>Email: <?php echo e($userShippingInfo['email']); ?></p>
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
        <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($purchase['productDescription']); ?></td>
                <td>$<?php echo e($purchase['price']); ?></td>
                <td><?php echo e($purchase['quantity']); ?></td>
                <td>$<?php echo e($purchase['productTotal']); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<div class="text-right">
    <h6>Subtotal: $<?php echo e($userPayment['subtotal']); ?></h6>
    <h6 class="mt-2">Shipping &amp; Handling: $<?php echo e($userPayment['shippingCost']); ?></h6>
    <h6 class="mt-2 text">Total: $<?php echo e($userPayment['total']); ?></h6>
</div>

<div>
    <h4>Payment</h4>
    <div class="row mb-3">
        <div class="col-md-5">
            <h6 class="mt-2">Card Type: <?php echo e($userPayment['cardType']); ?></h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3">
            <h6 class="mt-2">Card Number: <?php echo e($censoredCardNumber); ?></h6>
        </div>
        <div class="col-md-3">
            <h6 class="mt-2">Expiration Month: <?php echo e($userPayment['expirationMonth']); ?></h6>
        </div>
        <div class="col-md-3">
            <h6 class="mt-2">Expiration Year: <?php echo e($userPayment['expirationYear']); ?></h6>
        </div>
    </div>
    <?php if($userShippingInfo['comments'] != null): ?>
        <div>
            <h6 class="mt-2">Comments: <?php echo e($userShippingInfo['comments']); ?></h6>
        </div>   
    <?php endif; ?>
    <div class="text-right mb-3">
        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Home Page</a>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Matt/Documents/SCC-GIT/CIS230/Final Project/FinalProject/resources/views/receipt.blade.php ENDPATH**/ ?>