@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Statystyki - Przyjmowane leki</h2>

    <!-- Statystyki ogólne -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Łączna liczba pacjentów</h5>
                    <h2 class="text-primary">{{ $totalPatients }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Łączna liczba leków</h5>
                    <h2 class="text-success">{{ $totalMedications }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Przypisania leków</h5>
                    <h2 class="text-info">{{ $totalPatientMedications }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Aktywne leki</h5>
                    <h2 class="text-warning">{{ $activeMedications }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Najczęściej przepisywane leki -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Najczęściej przepisywane leki</h5>
                </div>
                <div class="card-body">
                    @if(count($mostPrescribedMedications) > 0)
                        <canvas id="medicationsChart" style="max-height: 400px;"></canvas>
                    @else
                        <p class="text-center">Brak danych</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pacjenci z największą liczbą leków -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pacjenci z największą liczbą leków</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Pacjent</th>
                                <th>Liczba leków</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patientsWithMostMedications as $patient)
                                <tr>
                                    <td>{{ $patient->name }} {{ $patient->s_name }}</td>
                                    <td>{{ $patient->patient_medications_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Brak danych</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Wykres pacjentów według wieku -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Rozkład pacjentów według wieku</h5>
                </div>
                <div class="card-body">
                    <canvas id="ageChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Wykres wieku pacjentów
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        const ageChart = new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ['0-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70+'],
                datasets: [{
                    label: 'Liczba pacjentów',
                    data: [
                        {{ $ageGroups['0-19'] }},
                        {{ $ageGroups['20-29'] }},
                        {{ $ageGroups['30-39'] }},
                        {{ $ageGroups['40-49'] }},
                        {{ $ageGroups['50-59'] }},
                        {{ $ageGroups['60-69'] }},
                        {{ $ageGroups['70+'] }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(201, 203, 207, 0.6)',
                        'rgba(255, 205, 86, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(255, 205, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Liczba pacjentów: ' + context.parsed.y;
                            }
                        }
                    }
                }
            }
        });

        // Wykres kołowy najczęściej przepisywanych leków
        @if(count($mostPrescribedMedications) > 0)
        const medicationsCtx = document.getElementById('medicationsChart');
        if (medicationsCtx) {
            const medicationsChart = new Chart(medicationsCtx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: [
                        @foreach($mostPrescribedMedications as $medication)
                            '{{ $medication['name'] }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Liczba przypisań',
                        data: [
                            @foreach($mostPrescribedMedications as $medication)
                                {{ $medication['count'] }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(201, 203, 207, 0.6)',
                            'rgba(255, 205, 86, 0.6)',
                            'rgba(155, 89, 182, 0.6)',
                            'rgba(46, 204, 113, 0.6)',
                            'rgba(241, 196, 15, 0.6)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(201, 203, 207, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(241, 196, 15, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return label + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }
        @endif
    });
</script>
@endpush
@endsection
