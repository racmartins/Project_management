@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h2">{{ $project->name }}</h1>
    <p>Priority: {{ ucfirst($project->priority) }}</p>
    <p>Start Date: {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
    <p>End Date: {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</p>
    <p>Current Progress: {{ round($progress_percentage, 2) }}%</p>

    <h3 class="mt-5">Project Evolution</h3>
    <canvas id="projectChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('projectChart').getContext('2d');
        var projectChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Progress Percentage',
                    data: @json($data),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    });
</script>
@endsection
