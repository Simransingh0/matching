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
        // Decode skills van het project en maak lowercase
        $projectSkills = json_decode($project->required_skills, true) ?? [];
        $projectSkillsLower = array_map('strtolower', $projectSkills);

        // Alle users laden
        $users = \App\Models\User::all();

        // Filter users die matching skills hebben en bereken percentage
        $matchedUsers = $users->map(function($user) use ($projectSkillsLower) {
            $userSkills = json_decode($user->skills, true) ?? [];
            $userSkillsLower = array_map('strtolower', $userSkills);

            $matchingSkills = array_intersect($projectSkillsLower, $userSkillsLower);
            $matchPercentage = count($matchingSkills) / max(count($projectSkillsLower), 1) * 100;

            $user->matchPercentage = $matchPercentage; // voeg property toe voor view
            return $user;
        })->filter(function($user) {
            return $user->matchPercentage > 0; // alleen users met matching skills
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
    public function show1(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }
    
    public function show(Project $project)
    {
       // Decode project skills naar array
        $requiredSkills = json_decode($project->required_skills, true) ?? [];

        // Alle profiles ophalen met bijbehorende user
        $profiles = Profile::with('user')->get();

        // Filter en bereken match percentage
        $matches = $profiles->map(function($profile) use ($requiredSkills) {
            // Zorg dat profiel skills een array is
            $profileSkills = is_array($profile->skills) ? $profile->skills : json_decode($profile->skills, true) ?? [];

            // Hoofdletter-ongevoelige vergelijking
            $matchingSkills = array_intersect(
                array_map('strtolower', $profileSkills),
                array_map('strtolower', $requiredSkills)
            );

            // Match percentage
            $matchPercentage = count($requiredSkills) > 0
                ? (count($matchingSkills) / count($requiredSkills)) * 100
                : 0;

            // Voeg matchPercentage en matchingSkills toe aan het profile object
            $profile->matchPercentage = round($matchPercentage, 2); // afgerond op 2 decimalen
            $profile->matchingSkills = $matchingSkills;

            return $profile;
        });

        // Alleen profiles met minstens 1 match tonen
        $matches = $matches->filter(fn($profile) => $profile->matchPercentage > 0);

        // Sorteer op matchPercentage (hoog naar laag)
        $matches = $matches->sortByDesc('matchPercentage');

        return view('projects.show', compact('project', 'matches', 'requiredSkills'));
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
