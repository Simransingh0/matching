@extends('layouts.app')

@section('content')

<div class="container py-5">

<!-- Header -->
<div class="text-center mb-5">
    <h1 class="display-4 fw-bold text-primary mb-2">Aanmeldingen Dashboard</h1>
    <p class="text-muted fs-5">Overzicht van alle projectaanmeldingen</p>
    <hr class="w-25 mx-auto border-2 border-primary rounded">
</div>

<!-- Card -->
<div class="card shadow-lg border-0 rounded-4 bg-white">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 fw-bold text-dark">Aanmeldingen Overzicht</h2>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Gebruiker</th>
                        <th>Project</th>
                        <th>Aangemeld op</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="fw-bold">{{ $application->user->name }}</td>
                            <td>{{ $application->project->title }}</td>
                            <td>{{ $application->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Geen aanmeldingen gevonden.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
</div>

<!-- Zelfde styling als andere pagina -->

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
    @media (max-width: 576px) {
        .card {
            padding: 2rem 1rem;
        }
        h1.display-4 {
            font-size: 2rem;
        }
    }
</style>

@endsection
