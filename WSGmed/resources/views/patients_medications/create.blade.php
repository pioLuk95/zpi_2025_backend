@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Przypisz lek do pacjenta</h2>
    <h4>{{ $patient->name }} {{ $patient->s_name }}</h4>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('patient-medications.store', $patient) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="medication_id" class="form-label">Lek:</label>
                    <select name="medication_id" id="medication_id" class="form-select @error('medication_id') is-invalid @enderror" required>
                        <option value="">-- Wybierz lek z listy --</option>
                        @foreach($medications as $medication)
                            @if(!in_array($medication->id, $assignedMedications))
                                <option value="{{ $medication->id }}" {{ old('medication_id') == $medication->id ? 'selected' : '' }}>
                                    {{ $medication->name }}@if($medication->info) - {{ $medication->info }}@endif
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('medication_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div id="selected-medication-info" class="alert alert-info d-none mb-3">
                    <strong>Wybrany lek:</strong> <span id="medication-name"></span>
                </div>

                <div class="mb-3">
                    <label for="dosage" class="form-label">Dawkowanie:</label>
                    <input type="text" name="dosage" id="dosage" class="form-control @error('dosage') is-invalid @enderror" 
                           value="{{ old('dosage') }}" placeholder="np. 1 tabletka" required>
                    @error('dosage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="frequency" class="form-label">Częstotliwość:</label>
                    <input type="text" name="frequency" id="frequency" class="form-control @error('frequency') is-invalid @enderror" 
                           value="{{ old('frequency') }}" placeholder="np. 2x dziennie" required>
                    @error('frequency')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Data rozpoczęcia:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                           value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">Data zakończenia (opcjonalnie):</label>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const medicationSelect = document.getElementById('medication_id');
    const selectedInfo = document.getElementById('selected-medication-info');
    const medicationName = document.getElementById('medication-name');
    
    medicationSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (this.value && selectedOption.text !== '-- Wybierz lek z listy --') {
            medicationName.textContent = selectedOption.text;
            selectedInfo.classList.remove('d-none');
        } else {
            selectedInfo.classList.add('d-none');
        }
    });
    
    // Wyświetl wybrany lek jeśli został już wybrany (np. po błędzie walidacji)
    if (medicationSelect.value) {
        medicationSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection 