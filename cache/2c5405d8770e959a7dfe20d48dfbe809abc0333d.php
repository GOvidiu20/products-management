

<?php $__env->startSection('configurations'); ?>
    <div class="navbar-conf">
        <div>
            <?php if($page > 1): ?>
                <a href="?page=<?php echo e($page - 1); ?>"><button>Previous</button></a>
            <?php else: ?>
                <button disabled>Previous</button>
            <?php endif; ?>

            <span>Page <?php echo e($page); ?> of <?php echo e($totalPages); ?></span>

            <?php if($page < $totalPages): ?>
                <a href="?page=<?php echo e($page + 1); ?>"><button>Next</button></a>
            <?php else: ?>
                <button disabled>Next</button>
            <?php endif; ?>
        </div>

        <input
            type="search"
            id="search"
            name="search"
            value="<?php echo e($search); ?>"
            placeholder="Search products..."
            oninput="updateSearch(this.value)"
        >

        <a href="/create">Add Product</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Availability</th>
            <th>In Stock</th>
        </thead>
        <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div class="table-image">
                        <img
                            src="/products/<?php echo e($product['image_path'] ?? 'default.jpg'); ?>"
                            alt="Product Image"
                            style="width:50px; height:50px; object-fit:cover; margin-right:10px; vertical-align:middle"
                        >
                    </div>
                    <a href=<?php echo e("/". $product['id'] . "/change"); ?>><?php echo e($product['name']); ?>

                </td>
                <td><?php echo e($product['description']); ?></td>
                <td><?php echo e($product['price']); ?></td>
                <td><?php echo e($product['availability_date']); ?></td>
                <td><?php echo e($product['in_stock'] ? 'Yes' : 'No'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<script>
    function updateSearch(value) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('search', value);
        urlParams.set('page', 1);
        window.location.search = urlParams.toString();
    }
</script>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ovidiu/projects/products_management_system/src/views/products/list-page.blade.php ENDPATH**/ ?>