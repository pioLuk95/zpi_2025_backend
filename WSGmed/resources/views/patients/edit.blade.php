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
</div>

@endsection