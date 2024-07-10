@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create Project
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Project List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></td>
                            <td>{{ ucfirst($project->priority) }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-bar-chart"></i> View Progress
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


