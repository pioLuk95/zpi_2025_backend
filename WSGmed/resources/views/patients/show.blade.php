@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Szczegóły pacjenta</h2>
     <a href="{{ route('patient-emergencies.show', $patient) }}" class="btn btn-primary mb-3">Pokaż emergency calle dla tego pacjenta</a>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $patient->name }} {{ $patient->s_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $patient->email }}</p>
            <p class="card-text"><strong>Data urodzenia:</strong> {{ $patient->date_of_birth }}</p>
            <p class="card-text"><strong>Lokalizacja:</strong> {{ $patient->location->name ?? 'Brak' }}</p>
            <p class="card-text"><strong>Leki:</strong> 
                @php $meds = $patient->medications ?? []; @endphp
                @if(count($meds))
                    @foreach($meds as $pm)
                        {{ $pm->medication->name }} ({{ $pm->dosage }} mg)@if(!$loop->last), @endif
                    @endforeach
                @else
                    Brak leków
                @endif
            </p>

            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">Edytuj</a>
            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Na pewno usunąć pacjenta?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Usuń</button>
            </form>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Powrót</a>
        </div>

        @if($patient->status === \app\Models\Patient::STATUS_DISCHARGED)
            @if($patient->discharge)
                <a href="{{ route('discharge.edit', $patient) }}" class="btn btn-primary mt-3">Edytuj wypis</a>
                <textarea class="form-control mt-2" rows="3" readonly>
                Data wypisu: {{ $patient->discharge->discharge_date }}
                Uwagi: {{ $patient->discharge->discharge_notes }}</textarea>
            @else
                <a href="{{ route('discharge.create', $patient) }}" class="btn btn-primary mt-3">Dodaj wypis</a>
            @endif
        @endif

        <a href="{{ route('staff_patients.renderAssign', $patient) }}" class="btn btn-primary mt-3">Dodaj nową osobę odpowiedzialną</a>
        Przypisany personel:
        <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Imię i nazwisko</th>
                    <th>Rola</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patient->staff as $staffMember)
                <tr>
                    <td><a href="{{ route("staff.show", $staffMember) }}">{{ $staffMember->name }} {{ $staffMember->s_name }}</a></td>
                    <td>{{ ucfirst($staffMember->role->name) }}</td>
                    <td>
                        <form action="{{ route('staff_patients.unassign', ['staff'=>$staffMember, 'patient'=>$patient]) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10">Brak wpisów</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <a href="{{ route('patient-medications.create', $patient) }}" class="btn btn-primary mt-3">Przypisz lek</a>

        <!-- Medications Table -->
        <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Nazwa leku</th>
                    <th>Informacje</th>
                    <th>Dawkowanie</th>
                    <th>Częstotliwość</th>
                    <th>Data rozpoczęcia</th>
                    <th>Data zakończenia</th>
                    <th>Potwierdzenia</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patient->patientMedications as $patientMedication)
                <tr>
                    <td>{{ $patientMedication->medication->name }}</td>
                    <td>{{ $patientMedication->medication->info }}</td>
                    <td>{{ $patientMedication->dosage }}</td>
                    <td>{{ $patientMedication->frequency }}</td>
                    <td>
                        @if($patientMedication->start_date)
                            @if(is_string($patientMedication->start_date))
                                {{ $patientMedication->start_date }}
                            @else
                                {{ $patientMedication->start_date->format('Y-m-d') }}
                            @endif
                        @else
                            Brak
                        @endif
                    </td>
                    <td>
                        @if($patientMedication->end_date)
                            @if(is_string($patientMedication->end_date))
                                {{ $patientMedication->end_date }}
                            @else
                                {{ $patientMedication->end_date->format('Y-m-d') }}
                            @endif
                        @else
                            Brak
                        @endif
                    </td>
                    <td>
                        <div class="mb-2">
                            <small class="text-muted">Liczba potwierdzeń: {{ $patientMedication->confirmations->count() }}</small>
                        </div>
                        @if($patientMedication->confirmations->count() > 0)
                            <details>
                                <summary class="btn btn-sm btn-info">Pokaż szczegóły</summary>
                                <div class="mt-2">
                                    @foreach($patientMedication->confirmations->sortByDesc('confirmation_date') as $confirmation)
                                        <div class="small">
                                            {{ $confirmation->confirmation_date ? $confirmation->confirmation_date->format('Y-m-d H:i') : 'Brak daty' }}
                                        </div>
                                    @endforeach
                                </div>
                            </details>
                        @endif
                        <button class="btn btn-sm btn-success mt-1" onclick="confirmMedication({{ $patientMedication->id }})">
                            Potwierdź przyjęcie
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('patient-medications.destroy', ['patient' => $patient, 'patientMedication' => $patientMedication]) }}" method="POST" onsubmit="return confirm('Na pewno usunąć ten lek?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8">Brak przypisanych leków</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <a href="{{ route('medical-records.create', $patient) }}" class="btn btn-primary mt-3">Dodaj wpis medyczny</a>
        Zapisy medyczne:

        <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Pacjent</th>
                    <th>Data</th>
                    <th>Ciśnienie</th>
                    <th>Temp.</th>
                    <th>Tętno</th>
                    <th>Waga</th>
                    <th>Nastrój</th>
                    <th>Ból</th>
                    <th>Saturacja</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                <tr>
                    <td>{{ $record->patient->name }} {{ $record->patient->s_name }}</td>
                    <td>{{ $record->record_date }}</td>
                    <td>{{ $record->blood_pressure }}</td>
                    <td>{{ $record->temperature }}</td>
                    <td>{{ $record->pulse }}</td>
                    <td>{{ $record->weight }}</td>
                    <td>{{ $record->mood }}</td>
                    <td>{{ $record->pain_level }}</td>
                    <td>{{ $record->oxygen_saturation }}</td>
                    <td>
                        <form action="{{ route('medical-records.destroy', $record) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10">Brak wpisów</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <a href="{{ route('recommendations.create', $patient) }}" class="btn btn-primary mt-3">Dodaj zalecenia</a>

        <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Osoba wystawiająca</th>
                    <th>Tytuł zalecenia</th>
                    <th>Treść</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patient->recommendations as $recommendation)
                <tr>
                    <td>{{ $recommendation->date }}</td>
                    <td>{{ $recommendation->staff->name }}</td>
                    <td>{{ $recommendation->tittle }}</td>
                    <td>{{ $recommendation->text }}</td>
                    <td>
                        <button class="btn btn-sm btn-info me-1" onclick="showRecommendation({{ $recommendation->id }})">
                            Podgląd
                        </button>
                        <form action="{{ route('recommendations.destroy', $recommendation) }}" method="POST" class="d-inline" onsubmit="return confirm('Na pewno usunąć?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10">Brak wpisów</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>

    </div>
</div>

<!-- Modal for Recommendation Preview -->
<div class="modal fade" id="recommendationModal" tabindex="-1" aria-labelledby="recommendationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationModalLabel">Szczegóły rekomendacji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Data:</strong> <span id="modalDate"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Osoba wystawiająca:</strong> <span id="modalStaff"></span>
                    </div>
                </div>
                <div class="row mb-3" id="modalTitleRow">
                    <div class="col-12">
                        <strong>Tytuł:</strong> <span id="modalTitle"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <strong>Treść:</strong>
                        <div id="modalText" class="mt-2 p-3 border bg-light" style="white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
@endsection
