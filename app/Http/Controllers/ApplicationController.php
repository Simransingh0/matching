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

    public function dashboard() {
        $user = Auth::user();

        if ($user->role === 'Admin') {
            $projects = \App\Models\Project::latest()->take(3)->get();
            $applications = collect(); // lege collectie zodat blade niet klaagt
            return view('dashboard', compact('projects', 'applications'));
        } else {
            $projects = collect(); // lege collectie voor blade
            $applications = $user->applications()->with('project')->get();
            return view('dashboard', compact('projects', 'applications'));
        }
    }

    public function cancel(Application $application)
    {
        // Optioneel: check dat de ingelogde gebruiker eigenaar is
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $application->delete();

        return redirect()->back()->with('success', 'Je aanmelding is verwijderd.');
    }

    public function destroy(Project $project){
        Application::where('user_id', Auth::id())
            ->where('project_id', $project->id)
            ->firstOrFail()
            ->delete();

        return back()->with('Succes', 'Je bent afgemeld van dit project.');
    }

    public function accept(Application $application){
        $application->update(['status' => 'accepted']);
        return back()->with('Succes', 'Aanmelding geaccepteerd!');
    }

    public function reject(Application $application){
        $application->update(['status' => 'rejected']);
        return back()->with(['status' => 'Aanmelding geweigerd!']);
    }
}
