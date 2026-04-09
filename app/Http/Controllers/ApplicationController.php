<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){
        $applications = Application::with(['user', 'project'])->latest()->get();

        return view('admin.applications.index', compact('applications'));
        
    }
    public function store(Project $project) {

        Application::create([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
        ]);

        return back()->with('Succes', 'Je hebt je aangemeld voor dit project!');
    }

    public function destroy(Project $project){
        Application::where('user_id', Auth::id())
            ->where('project_id', $project->id)
            ->firstOrFail()
            ->delete();

        return back()->with('Succes', 'Je bent afgemeld van dit project.');
    }
}
