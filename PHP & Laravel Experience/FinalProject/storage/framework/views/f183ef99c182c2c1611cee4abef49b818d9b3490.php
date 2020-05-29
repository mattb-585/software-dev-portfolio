<?php $__env->startSection('content'); ?>
<h1>Store - Cart</h1>

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
                <td>
                    <form method="GET" action="<?php echo e(route('cart-edit', [ 'id' => $purchase['id'] ])); ?>">
                        <label for="updateInput"></label>
                        <input type="text" value="<?php echo e($purchase['quantity']); ?>" id="updateInput" name="updateInput">
                        
                        <input type="submit" value="Update Quantity" class="btn btn-primary">
                    </form>
                </td>
                <td>$<?php echo e($purchase['productTotal']); ?></td>
                <td>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="hiddenId" value="<?php echo e($purchase['id']); ?>">
                    <a href="<?php echo e(route('cart-delete', [ 'id' => $purchase['id'] ])); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<div class="text-right">
      <h6>Subtotal: $<?php echo e($subtotal); ?></h6>
</div>

<div class="text-right">
    <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Continue Shopping</a>
    <a href="<?php echo e(route('shipping')); ?>" class="btn btn-primary">Next</a>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Matt/Documents/Software_Dev_Portfolio/PHP & Laravel Experience/FinalProject/resources/views/shoping-cart.blade.php ENDPATH**/ ?>