<?php $__env->startSection('content'); ?>
<h1>Store</h1>

<?php if(Session::has('info')): ?>
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-info"><?php echo e(Session::get('info')); ?></p>
    </div>
</div>
<?php endif; ?>

<?php if(count($errors->all())): ?>
  <div class="d-inline-block mt-3 alert alert-danger">
      <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
  </div>
<?php endif; ?>

<ul class="nav flex-column text-right" id="side-nav">
    <h6 class="navbar-brand">Categories</h6>
    <li class="nav-item">
      <a class="nav-link active" href="<?php echo e(route('clothing')); ?>">Clothing</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('mugs')); ?>">Mugs</a>
    </li>
</ul>

<div class="row row-cols-1 row-cols-md-3">
  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <?php if( strpos($product['name'], 'Shirt') == true ): ?>
    <div class="col mb-4">
      <div class="card">
          <img src=<?php echo e(asset('img/' . $product['image'])); ?> class="card-img-top" alt="placeholder">
          <div class="card-body text-center">
            <h5 class="card-title"><?php echo e($product['name']); ?></h5>
            <p>$<?php echo e(strval($prices->where('product_id', $product['id'])->last()->price)); ?></p>
            <form method="POST" action="<?php echo e(route('store-post')); ?>">
              <label for="sizeInput">Size:</label>
              <select name="sizeInput" class="form-control" id="sizeInput">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="X-Large">X-Large</option>
              </select>
                <br>
              <label for="quantityInput">Quantity:</label>
              <input type="text" id="quantityInput" name="quantityInput">
              <br>
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="hiddenId" value="<?php echo e($product['id']); ?>">
              <input type="submit" class="btn btn-primary" value="Add To Cart">
            </form>
          </div>
      </div>
    </div>
  <?php endif; ?>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Matt/Documents/Software_Dev_Portfolio/PHP & Laravel Experience/FinalProject/resources/views/clothing.blade.php ENDPATH**/ ?>