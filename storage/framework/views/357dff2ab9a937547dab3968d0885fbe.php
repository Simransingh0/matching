


<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    <div class="col-md-8 col-lg-6">

        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold text-primary mb-2">Profiel Bewerken</h1>
            <p class="text-muted">Pas de gegevens van de developer aan</p>
            <hr class="w-25 mx-auto border-2 border-primary rounded">
        </div>

        <div class="card shadow-lg border-0 rounded-4 bg-white p-4 p-md-5">
            <form action="<?php echo e(route('profiles.update', $profile->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label class="form-label fw-bold">Koppel aan User</label>
                    <select name="user_id" class="form-select" required>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>" <?php echo e($profile->user_id == $user->id ? 'selected' : ''); ?>>
                                <?php echo e($user->name); ?> (<?php echo e($user->email); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Skills (comma separated)</label>
                    <input type="text" name="skills" class="form-control" 
                        value="<?php echo e(implode(', ', json_decode($profile->skills, true) ?? [])); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Experience</label>
                    <input type="text" name="experience" class="form-control" value="<?php echo e($profile->experience); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Availability</label>
                    <input type="text" name="availability" class="form-control" value="<?php echo e($profile->availability); ?>">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="bi bi-save"></i> Opslaan
                    </button>
                    <a href="<?php echo e(route('profiles.index')); ?>" class="btn btn-secondary fw-bold ms-2">
                        <i class="bi bi-arrow-left-circle"></i> Terug
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>