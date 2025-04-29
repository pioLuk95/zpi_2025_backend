@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Szczegóły pacjenta</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $patient->name }} {{ $patient->s_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $patient->email }}</p>
            <p class="card-text"><strong>Data urodzenia:</strong> {{ $patient->date_of_birth }}</p>
            <p class="card-text"><strong>Lokalizacja:</strong> {{ $patient->location->name ?? 'Brak' }}</p>

            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">Edytuj</a>
            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Na pewno usunąć pacjenta?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Usuń</button>
            </form>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Powrót</a>
        </div>
    </div>
</div>
@endsection
