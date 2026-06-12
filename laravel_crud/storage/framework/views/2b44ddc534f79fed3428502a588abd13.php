<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="surface-card p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Nova disciplina</p>
                    <h1 class="h3 mb-0">Adicionar disciplina</h1>
                </div>
                <span class="badge bg-secondary">Campos obrigatórios</span>
            </div>
            <form method="POST" action="<?php echo e(route('disciplines.store')); ?>" novalidate>
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Nome da disciplina</label>
                    <input id="title" name="title" value="<?php echo e(old('title')); ?>" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="academic_year_id" class="form-label">Ano letivo</label>
                    <select id="academic_year_id" name="academic_year_id" class="form-select" required>
                        <option value="">Selecione um ano</option>
                        <?php $__currentLoopData = $academicYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($year->id); ?>" <?php echo e(old('academic_year_id') == $year->id ? 'selected' : ''); ?>><?php echo e($year->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Cor do cartão</label>
                    <input id="color" name="color" value="<?php echo e(old('color', '#2d6cdf')); ?>" type="color" class="form-control form-control-color" title="Escolher cor">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea id="description" name="description" rows="4" class="form-control"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary">Voltar</a>
                    <button type="submit" class="btn btn-brand">Criar disciplina</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/disciplines/create.blade.php ENDPATH**/ ?>