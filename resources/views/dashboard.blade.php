@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-2">Mijn Projecten</h1>
        <p class="text-muted fs-5">Bekijk projecten waar je op bent ingeschreven en meld je eventueel af</p>
        <hr class="w-25 mx-auto border-2 border-primary rounded">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($applications as $application)
            @php
                $project = $application->project;
                $skills = json_decode($project->required_skills, true) ?? [];
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                        <p class="card-text text-truncate">{{ $project->description }}</p>

                        <div class="mb-2">
                            @foreach($skills as $skill)
                                <span class="badge bg-info text-dark me-1 mb-1">{{ $skill }}</span>
                            @endforeach
                        </div>
                        <p class="card-text text-truncate text-succes">De status is: {{ $application->status }}</p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary btn-sm">
                                Bekijk Project
                            </a>

                            <form method="POST" action="{{ route('applications.cancel', $application->id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Afmelden
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted fs-5">Je hebt je nog niet aangemeld voor projecten.</p>
                <a href="{{ route('projects.index') }}" class="btn btn-success">Bekijk Projecten</a>
            </div>
        @endforelse
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
@endsection