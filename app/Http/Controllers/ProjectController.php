<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Profile;


class ProjectController extends Controller
{

    public function matches(Project $project)
    {
        // Decode skills van het project
        $projectSkills = json_decode($project->required_skills, true);
        if (!is_array($projectSkills)) $projectSkills = [];

        // Alle users laden
        $users = \App\Models\User::all();

        // Filter users die matching skills hebben
        $matchedUsers = $users->filter(function($user) use ($projectSkills) {
            $userSkills = json_decode($user->skills, true);
            if (!is_array($userSkills)) $userSkills = [];
            // Return true als minstens 1 skill matcht
            return count(array_intersect($projectSkills, $userSkills)) > 0;
        });

        return view('projects.matches', compact('project', 'matchedUsers', 'projectSkills'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'required_skills' => 'nullable'
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'required_skills' => json_encode(explode(',', $request->skills))
        ]);

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Project skills als array
        $requiredSkills = json_decode($project->required_skills, true) ?? [];

        // Alle profiles ophalen
        $profiles = Profile::with('user')->get();

        // Filter op skills
        $matches = $profiles->filter(function($profile) use ($requiredSkills) {
            // Zorg dat skills een array is
            $profileSkills = is_array($profile->skills) ? $profile->skills : json_decode($profile->skills, true) ?? [];

            // Minstens 1 skill match
            return count(array_intersect($profileSkills, $requiredSkills)) > 0;
        });

        return view('projects.show', compact('project', 'matches'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'required_skills' => 'nullable'
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'required_skills' => json_encode(array_map('trim', explode(',', $request->required_skills))),
        ]);

        return redirect()->route('projects.index')->with('Succes', 'Project bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
