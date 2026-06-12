<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="surface-card p-4 p-md-5">
            <h1 class="h3 mb-3">Entrar</h1>
            <p class="text-muted mb-4">Acesse sua produtividade acadêmica e organize disciplinas, tarefas e cadernos.</p>
            <form method="POST" action="<?php echo e(route('login.post')); ?>" novalidate>
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="remember">Lembrar-me</label>
                    </div>
                    <a href="<?php echo e(route('register')); ?>" class="small">Ainda não tem conta?</a>
                </div>
                <button type="submit" class="btn btn-brand w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/estudos/Embrapi/Notes_CRUD/laravel_crud/resources/views/auth/login.blade.php ENDPATH**/ ?>