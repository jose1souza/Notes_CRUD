<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Criar novo caderno</h1>
            <p class="text-muted mb-4">Associe este caderno a uma disciplina e comece a escrever suas anotações acadêmicas.</p>
            <form method="POST" action="<?php echo e(route('notebooks.store')); ?>" novalidate>
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Título do caderno</label>
                    <input id="title" name="title" value="<?php echo e(old('title')); ?>" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="discipline_id" class="form-label">Disciplina</label>
                    <select id="discipline_id" name="discipline_id" class="form-select" required>
                        <option value="">Selecione uma disciplina</option>
                        <?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($discipline->id); ?>" <?php echo e(old('discipline_id') == $discipline->id ? 'selected' : ''); ?>><?php echo e($discipline->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Primeira anotação</label>
                    <textarea id="content" name="content" rows="6" class="form-control" placeholder="Use Control + Z para desfazer enquanto escreve."><?php echo e(old('content')); ?></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Criar caderno</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/notebooks/create.blade.php ENDPATH**/ ?>