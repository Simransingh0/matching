

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="col-md-8 col-lg-6 mx-auto">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold text-primary mb-2">Matches voor <?php echo e($project->title); ?></h1>
            <p class="text-muted">Developers die minimaal 1 vereiste skill hebben van dit project</p>
            <hr class="w-25 mx-auto border-2 border-primary rounded">
        </div>

        <!-- Card -->
        <div class="card shadow-lg border-0 rounded-4 bg-white p-4 p-md-5">
            <?php if($matchedUsers->isEmpty()): ?>
                <p class="text-center text-muted fw-bold">Geen matches gevonden 😢</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $matchedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $userSkills = json_decode($user->skills, true) ?? [];
                            $commonSkills = array_intersect($userSkills, $projectSkills);
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo e($user->name); ?></strong>
                                <p class="mb-0 small text-muted"><?php echo e(implode(', ', $userSkills)); ?></p>
                            </div>
                            <span class="badge bg-success rounded-pill">
                                <?php echo e(count($commonSkills)); ?> match<?php echo e(count($commonSkills) > 1 ? 'es' : ''); ?>

                            </span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-secondary fw-bold">
                    <i class="bi bi-arrow-left-circle"></i> Terug
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    body {
        background: linear-gradient(135deg, #f0f4ff 0%, #d9e4ff 100%);
        font-family: 'Nunito', sans-serif;
    }
    .card {
        border-radius: 20px;
    }
    h1.display-5 {
        letter-spacing: 1px;
    }
    hr {
        border-top: 3px solid #0d6efd;
        width: 60px;
    }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/projects/matches.blade.php ENDPATH**/ ?>