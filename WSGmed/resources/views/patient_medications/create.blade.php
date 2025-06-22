@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Przypisz lek do pacjenta</h2>
    <h4>{{ $patient->name }} {{ $patient->s_name }}</h4>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('patient-medications.store', $patient) }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="medication_id">Lek:</label>
                    <select name="medication_id" id="medication_id" class="form-control @error('medication_id') is-invalid @enderror" required>
                        <option value="">Wybierz lek</option>
                        @foreach($medications as $medication)
                            @if(!in_array($medication->id, $assignedMedications))
                                <option value="{{ $medication->id }}" {{ old('medication_id') == $medication->id ? 'selected' : '' }}>
                                    {{ $medication->name }} - {{ $medication->info }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('medication_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dosage">Dawkowanie:</label>
                    <input type="text" name="dosage" id="dosage" class="form-control @error('dosage') is-invalid @enderror" 
                           value="{{ old('dosage') }}" placeholder="np. 1 tabletka" required>
                    @error('dosage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="frequency">Częstotliwość:</label>
                    <input type="text" name="frequency" id="frequency" class="form-control @error('frequency') is-invalid @enderror" 
                           value="{{ old('frequency') }}" placeholder="np. 2x dziennie" required>
                    @error('frequency')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start_date">Data rozpoczęcia:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                           value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date">Data zakończenia (opcjonalnie):</label>
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" 
                           value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Przypisz lek</button>
                    <a href="{{ route('patients.show', $patient) }}" class="btn btn-secondary">Anuluj</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 