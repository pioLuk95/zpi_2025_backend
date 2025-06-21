@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($patient) ? 'Edytuj Pacjenta' : 'Dodaj Pacjenta' }}</h1>

    <form method="POST" action="{{ isset($patient) ? route('patients.update', $patient) : route('patients.store') }}">
        @csrf

        @if(isset($patient))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Imię</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $patient->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="s_name" class="form-label">Nazwisko</label>
            <input type="text" class="form-control" id="s_name" name="s_name" value="{{ old('s_name', $patient->s_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Data urodzenia</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $patient->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="location_id" class="form-label">Lokalizacja</label>
            <select name="location_id" class="form-select" required>
                <option value="">-- wybierz lokalizację --</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" 
                        {{ old('location_id', $patient->location_id ?? '') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">{{ isset($patient) ? 'Zapisz zmiany' : 'Dodaj' }}</button>
    </form>

    @if(isset($patient))
        <hr>
        <h4>Edytuj przypisane leki</h4>
        @if($medications->count())
            <ul class="list-group mb-3">
                @foreach($medications as $pm)
                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <form action="{{ route('patients_medications.update', ['patient' => $patient->id, 'patientMedication' => $pm->id]) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        @method('PUT')
                        <select name="medication_id" class="form-select form-select-sm me-2" required>
                            @foreach(\App\Models\Medication::all() as $med)
                                <option value="{{ $med->id }}" {{ $pm->medication_id == $med->id ? 'selected' : '' }}>{{ $med->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="dosage" class="form-control form-control-sm me-2" value="{{ $pm->dosage }}" min="0" required style="width:90px;">
                        <span class="me-2">mg</span>
                        <button type="submit" class="btn btn-primary btn-sm me-2">Zapisz</button>
                    </form>
                    <form action="{{ route('patients_medications.destroy', ['patient' => $patient->id, 'patientMedication' => $pm->id]) }}" method="POST" onsubmit="return confirm('Na pewno usunąć lek?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Brak przypisanych leków</p>
        @endif
    @endif
</div>

@endsection