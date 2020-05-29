<?php $__env->startSection('content'); ?>
<h1>Store - Shipping & Billing</h1>

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

<div>
    <form method="GET" action="<?php echo e('shipping-add'); ?>" class="form">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Billing Information</h4>
                <div class="d-flex flex-row billingText">
                    <label for="billingFirstName" class="billingLabel">First Name:</label>
                    <input type="text" name="billingFirstName" id="billingFirstName" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->firstName : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingLastName" class="billingLabel">Last Name:</label>
                    <input type="text" name="billingLastName" id="billingLastName" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->lastName : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingAddress" class="billingLabel">Address:</label>
                    <input type="text" name="billingAddress" id="billingAddress" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->address : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingAddressTwo" class="billingLabel">Address Two:</label>
                    <input type="text" name="billingAddressTwo" id="billingAddressTwo" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->addressTwo : ''); ?>">
                </div> 
                <div class="d-flex flex-row billingText">
                    <label for="billingCity" class="billingLabel">City:</label>
                    <input type="text" name="billingCity" id="billingCity" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->city : ''); ?>">
                </div> 
                
                <div class="d-flex flex-row">
                    <label for="billingState" class="billingLabel">State:</label>
                    <select name="billingState" id="billingState" class="textboxWidth ml-auto mb-2 form-control">
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($state); ?>><?php echo e($state); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingZip" class="billingLabel">Zip:</label>
                    <input type="text" name="billingZip" id="billingZip" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->zip : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingPhone" class="billingLabel">Phone:</label>
                    <input type="text" name="billingPhone" id="billingPhone" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->phone : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="billingEmail" class="billingLabel">Email:</label>
                    <input type="text" name="billingEmail" id="billingEmail" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userBillingInfo->email : ''); ?>">
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
                    <input type="text" name="shippingFirstName" id="shippingFirstName" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->firstName : ''); ?>">
                </div>
                    <div class="d-flex flex-row billingText">
                    <label for="shippingLastName" class="billingLabel">Last Name:</label>
                    <input type="text" name="shippingLastName" id="shippingLastName" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->lastName : ''); ?>">
                </div>
                    <div class="d-flex flex-row billingText">
                    <label for="shippingAddress" class="billingLabel">Address:</label>
                    <input type="text" name="shippingAddress" id="shippingAddress" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->address : ''); ?>">
                </div>
                    <div class="d-flex flex-row billingText">
                    <label for="shippingAddressTwo" class="billingLabel">Address Two:</label>
                    <input type="text" name="shippingAddressTwo" id="shippingAddressTwo" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->addressTwo : ''); ?>">
                </div> 
                    <div class="d-flex flex-row billingText">
                    <label for="shippingCity" class="billingLabel">City:</label>
                    <input type="text" name="shippingCity" id="shippingCity" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->city : ''); ?>">
                </div> 
                <div class="d-flex flex-row">
                    <label for="shippingState" class="billingLabel">State:</label>
                    <select name="shippingState" id="shippingState" class="textboxWidth ml-auto mb-2 form-control">
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($state); ?>><?php echo e($state); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingZip" class="billingLabel">Zip:</label>
                    <input type="text" name="shippingZip" id="shippingZip" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->zip : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingPhone" class="billingLabel">Phone:</label>
                    <input type="text" name="shippingPhone" id="shippingPhone" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->phone : ''); ?>">
                </div>
                <div class="d-flex flex-row billingText">
                    <label for="shippingEmail" class="billingLabel">Email:</label>
                    <input type="text" name="shippingEmail" id="shippingEmail" class="textboxWidth ml-auto form-control" value="<?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->email : ''); ?>">
                </div>
            </div>
        </div>
        <div>
            <h4>Comments</h4>
            <textarea name="commentsInput" id="commentsInput" cols="100" rows="5" class="form-control"><?php echo e(url()->previous() == 'http://127.0.0.1:8000/preview' ? $userShippingInfo->comments : ''); ?></textarea>
        </div>
        <?php echo e(csrf_field()); ?>

        <div class="text-right mt-2">
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Back</a>
            <input type="submit" value="Next" class="btn btn-primary">
        </div>
    </form>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Matt/Documents/Software_Dev_Portfolio/PHP & Laravel Experience/FinalProject/resources/views/shipping-information.blade.php ENDPATH**/ ?>