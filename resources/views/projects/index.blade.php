@extends('layouts.app')

@section('content')

<div class="container py-5">

<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Header / Title -->
<div class="text-center mb-5">
    <h1 class="display-4 fw-bold text-primary mb-2">Projecten Dashboard</h1>
    <p class="text-muted fs-5">Bekijk, beheer en match projecten met developers</p>
    <hr class="w-25 mx-auto border-2 border-primary rounded">
</div>

<!-- Card -->
<div class="card shadow-lg border-0 rounded-4 bg-white">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 fw-bold text-dark">Projecten Overzicht</h2>

            @if(auth()->user()?->role === 'Admin')
                <a href="{{ route('projects.create') }}" class="btn btn-success fw-bold">
                    <i class="bi bi-plus-circle"></i> Nieuw Project
                </a>
            @endif
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
                    @foreach($projects as $project)
                        <tr>
                            <!-- Titel -->
                            <td class="fw-bold">{{ $project->title }}</td>

                            <!-- Beschrijving -->
                            <td>{{ $project->description }}</td>

                            <!-- Skills -->
                            <td>
                                @php
                                    $skills = json_decode($project->required_skills, true);
                                    if (!is_array($skills)) $skills = [];
                                @endphp

                                @foreach($skills as $skill)
                                    <span class="badge bg-info text-dark me-1 mb-1">{{ $skill }}</span>
                                @endforeach
                            </td>

                            <!-- Acties -->
                            <td>

                                <!-- Bekijk -->
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary btn-sm me-1 mb-1">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Aanmelden (user only) -->
                                @auth
                                    @if(auth()->user()->role !== 'Admin')

                                        @php
                                            $alreadyApplied = \App\Models\Application::where('user_id', auth()->id())
                                                ->where('project_id', $project->id)
                                                ->exists();
                                        @endphp

                                        @if($alreadyApplied)
                                            <form method="POST" action="{{ route('projects.unapply', $project->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Weet je zeker dat je wilt afmelden?')">
                                                    Afmelden
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('projects.apply', $project->id) }}" class="d-inline">
                                                @csrf
                                                <button class="btn btn-outline-primary btn-sm">
                                                    Meld aan
                                                </button>
                                            </form>
                                        @endif

                                    @endif
                                @endauth

                                <!-- Admin acties -->
                                @if(auth()->user()?->role === 'Admin')
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm me-1 mb-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm mb-1">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

<!-- Bootstrap Icons -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@endsection
