<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-2">Mijn Projecten</h1>
        <p class="text-muted fs-5">Bekijk projecten waar je op bent ingeschreven en meld je eventueel af</p>
        <hr class="w-25 mx-auto border-2 border-primary rounded">
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $project = $application->project;
                $skills = json_decode($project->required_skills, true) ?? [];
            ?>

            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold"><?php echo e($project->title); ?></h5>
                        <p class="card-text text-truncate"><?php echo e($project->description); ?></p>

                        <div class="mb-2">
                            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-info text-dark me-1 mb-1"><?php echo e($skill); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <p class="card-text text-truncate text-succes">De status is: <?php echo e($application->status); ?></p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="<?php echo e(route('projects.show', $project->id)); ?>" class="btn btn-primary btn-sm">
                                Bekijk Project
                            </a>

                            <form method="POST" action="<?php echo e(route('applications.cancel', $application->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-danger btn-sm">
                                    Afmelden
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center">
                <p class="text-muted fs-5">Je hebt je nog niet aangemeld voor projecten.</p>
                <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-success">Bekijk Projecten</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Extra Styling -->
<style>
    body {
        background: linear-gradient(135deg, #f0f4ff 0%, #d9e4ff 100%);
        font-family: 'Nunito', sans-serif;
    }

    .text-succes {
        color: green;
    }

    .card {
        border-radius: 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .badge {
        font-size: 0.85rem;
    }

    h1.display-4 {
        letter-spacing: 1px;
    }

    hr {
        border-top: 3px solid #0d6efd;
        width: 60px;
    }

    .btn-sm {
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/dashboard.blade.php ENDPATH**/ ?>