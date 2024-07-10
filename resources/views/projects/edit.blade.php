@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ isset($project) ? 'Edit Project' : 'Create Project' }}</h1>
            <form action="{{ isset($project) ? route('projects.update', $project) : route('projects.store') }}" method="POST">
                @csrf
                @if(isset($project))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($project) ? $project->name : old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option value="low" {{ (isset($project) && $project->priority == 'low') ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ (isset($project) && $project->priority == 'medium') ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ (isset($project) && $project->priority == 'high') ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ isset($project) ? $project->start_date : old('start_date') }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ isset($project) ? $project->end_date : old('end_date') }}" required>
                </div>
                <button type="submit" class="btn btn-success">{{ isset($project) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
