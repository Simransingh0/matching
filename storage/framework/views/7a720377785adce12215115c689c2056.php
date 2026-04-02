

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h1 class="display-5 fw-bold mb-4"><?php echo e($project->title); ?></h1>

    <h3 class="h5 mb-3 text-primary">Matching Developers</h3>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h5><?php echo e($profile->user->name); ?></h5>
                    <p><strong>Experience:</strong> <?php echo e($profile->experience); ?></p>
                    <p><strong>Availability:</strong> <?php echo e($profile->availability); ?></p>
                    <p>
                        <?php
                            $skills = is_array($profile->skills) ? $profile->skills : json_decode($profile->skills, true) ?? [];
                        ?>
                        <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-info text-dark me-1"><?php echo e($skill); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted">Geen geschikte developers gevonden.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/projects/show.blade.php ENDPATH**/ ?>