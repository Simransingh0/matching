@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <h2 class="text=2xl font-bold mb-6">Top 3 matches:</h2>

    @foreach($projects as $project)
        <div class="mb-6 p-4 border rounded shadow">
            <h2 class="text-xl font-semibold">{{ $project->title }}</h2>
            <p>Duur: {{ $project->total_hours }}</p>
            <p>Verwachte uren/week: {{ $project->weekly_hours }}</p>

            @if($project->topMatches->isEmpty())
                <p>Geen matches gevonden.</p>
            @else
                <ul>
                    @foreach($project->topMatches as $match)
                        <li class="mb-2">
                            {{ $match->user->name }} - {{ round($match->matchPercentage) }}%
                            <div class="progress h-4 bg-gray-200 rounded">
                                <div class="progress-bar bg-blue-500 h-4" 
                                    style="width: {{ $match->matchPercentage }}%"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('admin.projects.show', $project->id) }}" 
                class="mt-2 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 btn btn-primary ">
                Bekijk project
            </a>
        </div>
    @endforeach
</div>
@endsection