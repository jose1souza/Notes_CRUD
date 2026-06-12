<?php if(session('success')): ?>
    <div class="alert alert-success alert-card" role="status">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-card" role="alert">
        <strong>Verifique os campos abaixo:</strong>
        <ul class="mb-0 mt-2">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session('warning')): ?>
    <div class="alert alert-warning alert-card" role="alert">
        <?php echo e(session('warning')); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/partials/alerts.blade.php ENDPATH**/ ?>