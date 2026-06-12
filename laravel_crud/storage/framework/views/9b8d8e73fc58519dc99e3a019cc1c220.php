<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Nova tarefa</p>
                    <h1 class="h3 mb-0">Planejar entrega</h1>
                </div>
            </div>
            <form method="POST" action="<?php echo e(route('tasks.store')); ?>" novalidate>
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Título da tarefa</label>
                    <input id="title" name="title" value="<?php echo e(old('title')); ?>" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="discipline_id" class="form-label">Disciplina</label>
                    <select id="discipline_id" name="discipline_id" class="form-select" required>
                        <option value="">Selecione uma disciplina</option>
                        <?php $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discipline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($discipline->id); ?>" <?php echo e(old('discipline_id') == $discipline->id ? 'selected' : ''); ?>><?php echo e($discipline->title); ?> — <?php echo e($discipline->academicYear->title ?? 'Sem ano'); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Data de entrega</label>
                    <input id="due_date" name="due_date" type="datetime-local" value="<?php echo e(old('due_date')); ?>" class="form-control" required>
                    <div class="form-text">Datas anteriores ao momento da criação não são válidas.</div>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Observações</label>
                    <textarea id="note" name="note" rows="4" class="form-control"><?php echo e(old('note')); ?></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Salvar tarefa</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/tasks/create.blade.php ENDPATH**/ ?>