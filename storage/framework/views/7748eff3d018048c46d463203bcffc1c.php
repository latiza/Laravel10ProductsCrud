

<?php $__env->startSection('content'); ?>
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Products</h1>
           <a href="<?php echo e(route('products.create')); ?>" class='btn-link'>Add product</a>
        </div>
        <?php if($message = Session::get('success')): ?>
            <div>
                <ul>
                    <li><?php echo e($message); ?></li>
                </ul>
            </div>
            <script type="text/javascript">
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
            icon: 'success',
            title: '<?php echo e($message); ?>'
            })
            </script>
        <?php endif; ?>
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <form method="GET" action="<?php echo e(route('products.index')); ?>" accept-charset="UTF-8" role="search">
            <div class="table-search">   
                <div>
                    <button class="search-select">
                       Search Product
                    </button>
                    <span class="search-select-arrow">
                        <i class="fas fa-caret-down"></i>
                    </span>
                </div>
                <div class="relative">
                    <input class="search-input" type="text" name="search" placeholder="Search product..." name="search" value="<?php echo e(request('search')); ?>">
                </div>
            </div>
        </form>
            <div class="table-product-head">
                <p>Image</p>
                <p>Name</p>
                <p>Category</p>
                <p>Inventory</p>
                <p>Actions</p>
            </div>
            <div class="table-product-body">
                <?php if(count($products) > 0): ?>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('images/' . $product->image)); ?>"/>
                    <p> <?php echo e($product->name); ?></p>
                    <p><?php echo e($product->category); ?></p>
                    <p><?php echo e($product->quantity); ?></p>
                    <div class="buttons">     
                        <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-success">
                            <i class="fas fa-pencil-alt" ></i> 
                        </a>
                        <form method="post" action="<?php echo e(route('products.destroy' , $product->id)); ?>">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                            <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <p>Product not found in database</p>
                <?php endif; ?>
                
            </div>
            <div class="table-paginate">
                <?php echo e($products->links('layouts.pagination')); ?>

               
            </div>
        </div>
    </section>
</main>
<script>
    window.deleteConfirm = function(e){
        e.preventDefault();
        let form = e.target.form;
        //https://sweetalert2.github.io/
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
         form.submit();
  }
})
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\photogallery\resources\views/products/index.blade.php ENDPATH**/ ?>