<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($title ?? 'Products Management'); ?></title>
    <link rel="stylesheet" href="/style.css">

</head>
<body>
<header class="navbar">
    <h1>Products Management</h1>
    <div>
        <?php echo $__env->yieldContent('configurations'); ?>
    </div>
</header>

<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH /home/ovidiu/projects/products_management_system/src/views/layouts/main.blade.php ENDPATH**/ ?>