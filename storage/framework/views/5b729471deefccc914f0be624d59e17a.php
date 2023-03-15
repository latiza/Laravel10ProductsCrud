
<?php $__env->startSection('content'); ?>
<main class="container">
    <section>
        <form method="post" action="<?php echo e(route('products.update', $product->id)); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>  
          <?php echo method_field('PUT'); ?>
        <div class="titlebar">
            <h1>Edit Product</h1>
            <button>Save</button>
        </div>
        <?php if($errors->any): ?>
            <div>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card">
           <div>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo e($product->name); ?>">
                <label>Description (optional)</label>
                <textarea cols="10" rows="5" name="description" value="<?php echo e($product->description); ?>"><?php echo e($product->description); ?></textarea>
                <label>Add Image</label>
                <img src="<?php echo e(asset('image/'.$product->image)); ?>" alt="" class="img-product" id="file-preview"/>
                <input type="hidden" name="hidden_product_image" value="<?php echo e($product->image); ?>">
                <input type="file" name="image" accept="image/*" onchange="showFile(event)">
            </div>
           <div>
                <label>Category</label>
                <select  name="category">
                    <?php $__currentLoopData = json_decode('{"Smartphone":"Smartphone", "Smart TV":"Smart TV", "Computer":"Computer"}',true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($product->category) && $product->category == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <hr>
                <label>Inventory</label>
                <input type="text" name="quantity" value='<?php echo e($product->quantity); ?>'>
                <hr>
                <label>Price</label>
                <input type="text" name="price" value="<?php echo e($product->price); ?>">
           </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <input type="hidden" name="hidden_id" value="<?php echo e($product->id); ?>">
            <button>Save</button>
        </div>
    </form>
    </section>
    
</main>
<script>
    function showFile(event){
        let input = event.target;
        let reader = new FileReader();
        reader.onload = function(){
            let dataURL = reader.result;
            let output = document.getElementById('file-preview');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\photogallery\resources\views/products/edit.blade.php ENDPATH**/ ?>