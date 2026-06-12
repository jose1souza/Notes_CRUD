<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Criar novo ano letivo</h1>
            <p class="text-muted mb-4">Defina o período acadêmico para organizar disciplinas e notas.</p>
            <form method="POST" action="<?php echo e(route('academic-years.store')); ?>" novalidate>
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Título do ano letivo</label>
                    <input id="title" name="title" value="<?php echo e(old('title')); ?>" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea id="description" name="description" rows="4" class="form-control"><?php echo e(old('description')); ?></textarea>
                </div>
                <button type="submit" class="btn btn-brand">Salvar ano letivo</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/academic-years/create.blade.php ENDPATH**/ ?>