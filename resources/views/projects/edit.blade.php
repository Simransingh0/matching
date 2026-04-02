@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    <div class="col-md-8 col-lg-6">

        <div class="text-center mb-4">
            <h1 class="display-5 fw-bold text-primary mb-2">Project Bewerken</h1>
            <p class="text-muted">Pas de gegevens van het project aan</p>
            <hr class="w-25 mx-auto border-2 border-primary rounded">
        </div>

        <div class="card shadow-lg border-0 rounded-4 bg-white p-4 p-md-5">
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Titel</label>
                    <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Beschrijving</label>
                    <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Vereiste Skills (comma separated)</label>
                    <input type="text" name="required_skills" class="form-control" 
                        value="{{ implode(', ', json_decode($project->required_skills, true) ?? []) }}">
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="bi bi-save"></i> Opslaan
                    </button>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary fw-bold ms-2">
                        <i class="bi bi-arrow-left-circle"></i> Terug
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection