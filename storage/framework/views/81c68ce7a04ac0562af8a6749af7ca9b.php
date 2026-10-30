

<?php $__env->startSection('title', 'Login - Macah Bakery'); ?>

<?php $__env->startSection('auth-content'); ?>
<h4 class="text-center mb-4" style="color: #5C2E0A;">Login</h4>

<?php if(session('error')): ?>
<div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<form method="POST" action="/login">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn w-100" style="background: #C9943A; color: #fff; border-radius: 30px; padding: 12px;">
        Login
    </button>
</form>
<div class="text-center mt-3">
    <small>Belum punya akun? <a href="/register" style="color: #C9943A;">Register</a></small>
</div>
<div class="text-center mt-2">
    <small><a href="<?php echo e(route('admin.login')); ?>" style="color: #8a7a6d;">Login sebagai Admin</a></small>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\macahbakery\resources\views/auth/login.blade.php ENDPATH**/ ?>