<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Profile;
use App\Models\USer;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 3 nieuwste projecten ophalen
        $projects = Project::latest()->take(3)->get();

        // Voor elk project top 3 matches berekenen
        $projects->each(function($project) {
            $profiles = Profile::all(); // alle vrijwilligers
            $matches = $profiles->map(function($profile) use ($project) {
                $profile->matchPercentage = $this->calculateMatchPercentage($profile->skills, $project->required_skills);
                return $profile;
            })
            ->sortByDesc('matchPercentage')
            ->take(3); // top 3 matches

            $project->topMatches = $matches;
        });

        return view('admin.dashboard', compact('projects'));
    }

    private function calculateMatchPercentage($volunteerSkills, $projectSkills)
    {
        $volunteerSkills = array_map('strtolower', json_decode($volunteerSkills, true));
        $projectSkills = array_map('strtolower', json_decode($projectSkills, true));

        $overlap = count(array_intersect($volunteerSkills, $projectSkills));
        return $overlap / max(count($projectSkills), 1) * 100;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
