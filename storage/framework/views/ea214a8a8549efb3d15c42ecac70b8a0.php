<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Header / Title -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-2">Projecten Dashboard</h1>
        <p class="text-muted fs-5">Bekijk, beheer en match projecten met developers</p>
        <hr class="w-25 mx-auto border-2 border-primary rounded">
    </div>

    <!-- Card container -->
    <div class="card shadow-lg border-0 rounded-4 bg-white">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 fw-bold text-dark">Projecten Overzicht</h2>
                <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-success fw-bold">
                    <i class="bi bi-plus-circle"></i> Nieuw Project
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Titel</th>
                            <th>Beschrijving</th>
                            <th>Skills</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="align-middle">
                                <td class="fw-bold"><?php echo e($project->title); ?></td>
                                <td><?php echo e($project->description); ?></td>
                                <td>
                                    <?php
                                        $skills = json_decode($project->required_skills, true);
                                        if (!is_array($skills)) $skills = [];
                                    ?>
                                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-info text-dark me-1 mb-1"><?php echo e($skill); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('projects.show', $project->id)); ?>" class="btn btn-primary btn-sm me-1 mb-1">
                                        <i class="bi bi-people-fill"></i>
                                    </a>
                                    <a href="<?php echo e(route('projects.edit', $project->id)); ?>" class="btn btn-warning btn-sm me-1 mb-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="<?php echo e(route('projects.destroy', $project->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-danger btn-sm mb-1">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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
    h1.display-4 {
        letter-spacing: 1px;
    }
    hr {
        border-top: 3px solid #0d6efd;
        width: 60px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.1);
    }
    .btn i {
        margin-right: 4px;
    }
    .badge {
        font-size: 0.85rem;
    }
    @media (max-width: 576px) {
        .card {
            padding: 2rem 1rem;
        }
        h1.display-4 {
            font-size: 2rem;
        }
    }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/projects/index.blade.php ENDPATH**/ ?>