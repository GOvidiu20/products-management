

<?php $__env->startSection('configurations'); ?>
    <div class="navbar-conf">
        <button onclick="save(<?php echo e($product['id'] ?? null); ?>)">
            <?php echo e($product ? 'Save Changes' : 'Create Product'); ?>

        </button>
        <?php if($product): ?>
            <button onclick="deleteProduct(<?php echo e($product['id']); ?>)">Delete Product</button>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="form-group">
            <label for="name" class="required">Name</label>
            <input type="text" id="name" value="<?php echo e($product['name'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="price" class="required">Price</label>
            <input type="number" id="price" step="0.01" value="<?php echo e($product['price'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="availability_date">Availability date</label>
            <input type="date" id="availability_date" value="<?php echo e($product['availability_date'] ?? null); ?>">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <?php if(!empty($product['image_path'])): ?>
                <div class="image-preview">
                    <img src="/products/<?php echo e($product['image_path']); ?>" alt="Product Image" style="max-width:150px; display:block; margin-bottom:10px;">
                </div>
            <?php endif; ?>

            <input type="file" id="image" accept="image/*">
        </div>

        <div class="form-group checkbox-group">
            <label for="in_stock">In Stock</label>
            <input type="checkbox"
                   id="in_stock"
                    <?php echo e(!empty($product['in_stock']) ? 'checked' : ''); ?>>
        </div>

        <div class="form-group full-width">
            <label for="description">Description</label>
            <textarea id="description"><?php echo e($product['description'] ?? ''); ?></textarea>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script src="/products.js"></script>
<?php echo $__env->make('layouts.main', ['title' => 'Change Product'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ovidiu/projects/products_management_system/src/views/products/change-page.blade.php ENDPATH**/ ?>