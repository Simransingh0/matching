@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="display-5 fw-bold mb-4">{{ $project->title }}</h1>

    <h3 class="h5 mb-3 text-primary">Matching Developers</h3>
    <div class="row">
        @forelse($matches as $profile)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h5>{{ $profile->user->name }}</h5>
                    <p><strong>Experience:</strong> {{ $profile->experience }}</p>
                    <p><strong>Availability:</strong> {{ $profile->availability }}</p>
                    <p>
                        @php
                            $skills = is_array($profile->skills) ? $profile->skills : json_decode($profile->skills, true) ?? [];
                        @endphp
                        @foreach($skills as $skill)
                            <span class="badge bg-info text-dark me-1">{{ $skill }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        @empty
            <p class="text-muted">Geen geschikte developers gevonden.</p>
        @endforelse
    </div>
</div>
@endsection