


<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="col-md-10 col-lg-8 mx-auto">

        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold text-primary mb-2">Developer Profielen</h1>
            <p class="text-muted">Beheer alle developer profielen en hun skills</p>
            <hr class="w-25 mx-auto border-2 border-primary rounded">
        </div>

        <div class="card shadow-lg border-0 rounded-4 bg-white p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 fw-bold text-dark">Alle Profielen</h2>
                <a href="<?php echo e(route('profiles.create')); ?>" class="btn btn-success fw-bold">
                    <i class="bi bi-plus-circle"></i> Nieuw Profiel
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Naam</th>
                            <th>User</th>
                            <th>Skills</th>
                            <th>Experience</th>
                            <th>Availability</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $skills = json_decode($profile->skills, true) ?? [];
                            ?>
                            <tr>
                                <td><?php echo e($profile->name); ?></td>
                                <td><?php echo e($profile->user->name); ?></td>
                                <td>
                                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-info text-dark me-1 mb-1"><?php echo e($skill); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($profile->experience); ?></td>
                                <td><?php echo e($profile->availability); ?></td>
                                <td>
                                    <a href="<?php echo e(route('profiles.edit', $profile->id)); ?>" class="btn btn-warning btn-sm me-1 mb-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="<?php echo e(route('profiles.destroy', $profile->id)); ?>" method="POST" class="d-inline">
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body { background: linear-gradient(135deg, #f0f4ff 0%, #d9e4ff 100%); font-family: 'Nunito', sans-serif; }
    .card { border-radius: 20px; }
    h1.display-5 { letter-spacing: 1px; }
    hr { border-top: 3px solid #0d6efd; width: 60px; }
    .table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.1); }
    .btn i { margin-right: 4px; }
    .badge { font-size: 0.85rem; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/admin/profile/index.blade.php ENDPATH**/ ?>