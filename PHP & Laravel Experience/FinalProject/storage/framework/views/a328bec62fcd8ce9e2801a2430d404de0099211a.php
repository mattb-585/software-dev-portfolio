<?php $__env->startSection('content'); ?>
<h1>Store - Preview Order</h1>

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
    <form method="GET" action="preview">
        <h6>Subtotal: $<?php echo e($subtotal); ?></h6>
        <label for="priorityInput">Shipping Options:</label>
        <select name="priorityInput" class="form-control" id="priorityInput">
            <option value="0.00" >U.S.P.S Free (4-5 days)</option>
            <option value="5.99" <?php echo e($shippingPriority  == "5.99" ? 'selected' : ''); ?>>U.S.P.S Priority #1 (Same Day)</option>
            <option value="3.99" <?php echo e($shippingPriority  == "3.99" ? 'selected' : ''); ?>>U.S.P.S Priority #2 (2-3 days)</option>
        </select>
        <h6 class="mt-2">Shipping &amp; Handling: $<?php echo e($shippingPriority != null ? $shippingPriority : 0.00); ?></h6>
        <h6 class="mt-2 text">Total: $<?php echo e($total); ?></h6>
        <input type="submit" value="Update Total" class="btn btn-primary">
    </form>
</div>

<div>
    <h4>Payment</h4>
    <form method="GET" action="<?php echo e(route('add-payment')); ?>">
        <?php echo e(csrf_field()); ?>

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
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Back</a>
            <input type="submit" value="Purchase" class="btn btn-primary">
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Matt/Documents/SCC-GIT/CIS230/Final Project/FinalProject/resources/views/preview-order.blade.php ENDPATH**/ ?>