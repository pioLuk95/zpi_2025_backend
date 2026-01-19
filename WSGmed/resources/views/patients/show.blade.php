@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Szczegóły pacjenta</h2>
     <a href="{{ route('patient-emergencies.show', $patient) }}" class="btn btn-primary mb-3">Pokaż emergency calle dla tego pacjenta</a>

    <div class="card mt-3 p-5">
        <div class="card-body">
            <h5 class="card-title">{{ $patient->name }} {{ $patient->s_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $patient->email }}</p>
            <p class="card-text"><strong>Data urodzenia:</strong> {{ $patient->date_of_birth }}</p>

            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">Edytuj</a>
            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Na pewno usunąć pacjenta?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Usuń</button>
            </form>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Powrót</a>
        </div>

        <a href="{{ route('staff_patients.renderAssign', $patient) }}" class="btn btn-primary mt-3">Dodaj nową osobę odpowiedzialną</a>
        Przypisany personel:
        <table class="table table-bordered">
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

        <a href="{{ route('patient-medications.create', $patient) }}" class="btn btn-primary mt-3">Przypisz lek</a>

        <!-- Medications Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nazwa leku</th>
                    <th>Informacje</th>
                    <th>Dawkowanie</th>
                    <th>Częstotliwość</th>
                    <th>Data rozpoczęcia</th>
                    <th>Data zakończenia</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patient->patientMedications as $patientMedication)
                <tr>
                    <td>{{ $patientMedication->medication->name }}</td>
                    <td>{{ $patientMedication->medication->info }}</td>
                    <td>{{ $patientMedication->dosage }} mg</td>
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
                        <form action="{{ route('patient-medications.destroy', ['patient' => $patient, 'patientMedication' => $patientMedication]) }}" method="POST" onsubmit="return confirm('Na pewno usunąć ten lek?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">Brak przypisanych leków</td></tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('medical-records.create', $patient) }}" class="btn btn-primary mt-3">Dodaj wpis medyczny</a>
        Zapisy medyczne:

        <table class="table table-bordered">
            <thead>
                <tr>
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
                    <td>{{ $record->insert_date }}</td>
                    <td>{{ $record->blood_pressure }}</td>
                    <td>{{ $record->temperature }}</td>
                    <td>{{ $record->pulse }}</td>
                    <td>{{ $record->weight }}</td>
                    <td>{{ $record->mood_label }}</td>
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

        <a href="{{ route('recommendations.create', $patient) }}" class="btn btn-primary mt-3">Dodaj zalecenia</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Osoba wystawiająca</th>
                    <th>Treść</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patient->recommendations as $recommendation)
                <tr>
                    <td>{{ $recommendation->date }}</td>
                    <td>{{ $recommendation->staff->name }}</td>
                    <td>{{ $recommendation->text }}</td>
                    <td>
                        <form action="{{ route('recommendations.destroy', $recommendation) }}" method="POST">
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
@endsection
