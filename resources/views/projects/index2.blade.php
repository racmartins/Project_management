@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h2">Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ ucfirst($project->priority) }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

