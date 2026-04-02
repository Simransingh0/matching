

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    <div class="col-md-8 col-lg-6">

        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold text-primary mb-2">Nieuw Project</h1>
            <p class="text-muted">Vul de gegevens in om een nieuw project toe te voegen</p>
            <hr class="w-25 mx-auto border-2 border-primary rounded">
        </div>

        <!-- Form Card -->
        <div class="card shadow-lg border-0 rounded-4 bg-white p-4 p-md-5">
            <form action="<?php echo e(route('projects.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Titel</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Bijv. Website Ontwikkeling" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Beschrijving</label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Korte omschrijving van het project"></textarea>
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label fw-bold">Skills (comma separated)</label>
                    <input type="text" id="skills" name="skills" class="form-control" placeholder="php, laravel, js">
                    <small class="text-muted">Voer skills in gescheiden door komma’s</small>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="bi bi-plus-circle"></i> Project Toevoegen
                    </button>
                    <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-secondary fw-bold ms-2">
                        <i class="bi bi-arrow-left-circle"></i> Terug
                    </a>
                </div>

            </form>
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
    .btn i {
        margin-right: 4px;
    }
    .form-label {
        font-weight: 600;
    }
    @media (max-width: 576px) {
        .card {
            padding: 2rem 1rem;
        }
        h1.display-5 {
            font-size: 2rem;
        }
    }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Simran\Herd\matching-platform\resources\views/projects/create.blade.php ENDPATH**/ ?>