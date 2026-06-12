<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-start justify-content-between mb-4 gap-3">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Caderno</p>
                    <h1 class="h3 mb-1"><?php echo e($notebook->title); ?></h1>
                    <p class="text-muted mb-0">Disciplina: <?php echo e($notebook->discipline->title); ?></p>
                </div>
                <span class="badge bg-info text-dark"><?php echo e($notebook->updated_at->diffForHumans()); ?></span>
            </div>
            <form method="POST" action="<?php echo e(route('notebooks.update', $notebook)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="content" class="form-label">Escrever anotações</label>
                    <textarea id="content" name="content" rows="12" class="form-control" placeholder="Use Control + Z para desfazer alterações enquanto escreve."><?php echo e(old('content', $notebook->content)); ?></textarea>
                </div>
                <button type="submit" class="btn btn-brand">Salvar anotações</button>
                <span class="text-muted small ms-3">Suas anotações serão salvas e mantidas no caderno.</span>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/notebooks/show.blade.php ENDPATH**/ ?>