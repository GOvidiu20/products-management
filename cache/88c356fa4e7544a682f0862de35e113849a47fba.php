

<?php $__env->startSection('configurations'); ?>
    <div class="navbar-conf">
        <button onclick="save()">
            <?php echo e($product ? 'Save Changes' : 'Create Product'); ?>

        </button>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <div class="container">
       <div class="form-group">
           <label>Name</label>
           <input type="text" id="name" value="<?php echo e($product->name); ?>" required>
       </div>
       <div class="form-group">
           <label>Price</label>
           <input type="number" id="price" step="0.01" value="<?php echo e($product->price); ?>" required>
       </div>
       <div class="form-group">
           <label>Availability date</label>
           <input type="date" id="availability_date" value="<?php echo e($product ? $product->availability_date->format('Y-m-d') : null); ?>" required>
       </div>
       <div class="form-group">
           <label>Image</label>
           <input type="file" alt="" id="image">
       </div>
       <div class="form-group">
           <label>Description</label>
           <textarea id="description" value="<?php echo e($product->description); ?>"></textarea>
       </div>
   </div>
<?php $__env->stopSection(); ?>

<script>
    function save() {
        const formData = new FormData();

        formData.append('name', document.getElementById('name').value);
        formData.append('price', document.getElementById('price').value);
        formData.append('availability_date', document.getElementById('availability_date').value);
        formData.append('description', document.getElementById('description').value);

        const imageInput = document.getElementById('image');
        if (imageInput.files.length > 0) {
            formData.append('image_path', imageInput.files[0]);
        }

        fetch('/store', {
            method: 'POST',
            body: formData
        })
            .then(data => {
                if (data.ok) {
                    alert('Product saved successfully!');

                    window.location.href = '/';
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving the product.');
            });
    }
</script>
<?php echo $__env->make('layouts.main', ['title' => 'Change Product'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ovidiu/projects/products_management_system/src/views/products/change-page.blade.php ENDPATH**/ ?>