<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'priority' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Excluir o campo _token dos dados da requisição
        $data = $request->except('_token');

        // Criar um novo projeto associado ao user autenticado
        Auth::user()->projects()->create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        // Calcular os dias de progresso
        $start_date = \Carbon\Carbon::parse($project->start_date);
        $end_date = \Carbon\Carbon::parse($project->end_date);
        $current_date = \Carbon\Carbon::now();

        $total_days = $start_date->diffInDays($end_date);
        $days_passed = $start_date->diffInDays($current_date);

        $progress_percentage = ($days_passed / $total_days) * 100;

        $labels = [];
        $data = [];

        for ($i = 0; $i <= $total_days; $i++) {
            $labels[] = $start_date->copy()->addDays($i)->format('d/m/Y');
            $data[] = ($i / $total_days) * 100;
        }

        return view('projects.show', compact('project', 'labels', 'data', 'progress_percentage'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'priority' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

}
