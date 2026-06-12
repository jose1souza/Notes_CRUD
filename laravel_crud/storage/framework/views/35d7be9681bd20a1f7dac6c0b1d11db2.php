<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="surface-card p-4">
            <div class="d-flex align-items-start justify-content-between mb-4 gap-3">
                <div>
                    <p class="text-uppercase text-primary small mb-1">Disciplina</p>
                    <h1 class="h3 mb-1"><?php echo e($discipline->title); ?></h1>
                    <p class="text-muted mb-0"><?php echo e($discipline->academicYear->title ?? 'Ano Letivo não definido'); ?></p>
                </div>
                <span class="status-pill <?php echo e($discipline->tasks->where('completed', false)->count() ? 'pending' : 'completed'); ?>"><?php echo e($discipline->tasks->where('completed', false)->count()); ?> pendentes</span>
            </div>
            <div class="mb-4">
                <p><?php echo e($discipline->description ?: 'Descrição não informada.'); ?></p>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card card-compact p-3 h-100">
                        <h3 class="h6">Cadernos</h3>
                        <p class="text-muted mb-3"><?php echo e($discipline->notebooks->count()); ?> cadernos criados.</p>
                        <a href="<?php echo e(route('notebooks.create')); ?>" class="btn btn-outline-primary btn-sm">Adicionar caderno</a>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-compact p-3 h-100">
                        <h3 class="h6">Tarefas</h3>
                        <p class="text-muted mb-3"><?php echo e($discipline->tasks->count()); ?> tarefas registradas.</p>
                        <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-outline-primary btn-sm">Adicionar tarefa</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="surface-card p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h5 mb-0">Tarefas da disciplina</h2>
                <span class="small text-muted">Arraste pelo cronograma mental</span>
            </div>
            <?php if($discipline->tasks->isEmpty()): ?>
                <div class="text-center py-5">
                    <p class="text-muted">Nenhuma tarefa cadastrada nesta disciplina.</p>
                    <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-brand">Criar tarefa</a>
                </div>
            <?php else: ?>
                <div class="list-group">
                    <?php $__currentLoopData = $discipline->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <strong><?php echo e($task->title); ?></strong>
                                <div class="small text-muted">Entrega em <?php echo e($task->due_date->format('d/m/Y H:i')); ?></div>
                                <div class="small mt-1 text-<?php echo e($task->completed ? 'success' : 'warning'); ?>">
                                    <?php echo e($task->completed ? 'Concluída' : 'Essa tarefa não foi concluída'); ?>

                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <form method="POST" action="<?php echo e(route('tasks.toggle', $task)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Alterar</button>
                                </form>
                                <form method="POST" action="<?php echo e(route('tasks.destroy', $task)); ?>" onsubmit="return confirm('Deseja mesmo excluir esta tarefa?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="surface-card p-4">
            <h2 class="h6 mb-3">Detalhes rápidos</h2>
            <p class="text-muted">Cor do cartão: <strong><?php echo e($discipline->color ?: ' Padrão'); ?></strong></p>
            <div class="mb-3">
                <span class="badge text-bg-light" style="color: <?php echo e($discipline->color ?: '#2d6cdf'); ?>; border: 1px solid <?php echo e($discipline->color ?: '#2d6cdf'); ?>;">Visualizar cor</span>
            </div>
            <div class="d-grid gap-2">
                <a href="<?php echo e(route('disciplines.create')); ?>" class="btn btn-outline-primary w-100 mb-2">Editar disciplina</a>
                <form method="POST" action="<?php echo e(route('disciplines.destroy', $discipline)); ?>" onsubmit="return confirm('Deseja mesmo excluir esta disciplina?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger w-100">Excluir disciplina</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/disciplines/show.blade.php ENDPATH**/ ?>