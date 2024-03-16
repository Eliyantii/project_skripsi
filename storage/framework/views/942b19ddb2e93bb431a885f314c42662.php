<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
  </head>
  <body>
    
    <?php $__currentLoopData = $janda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h1>Nama : <?php echo e($eli->name); ?></h1>
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </body>
</html><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/eliTest.blade.php ENDPATH**/ ?>