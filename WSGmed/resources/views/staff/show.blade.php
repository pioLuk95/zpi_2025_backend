@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Szczegóły workera</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $staff->name }} {{ $staff->s_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $staff->email }}</p>
            <p class="card-text"><strong>Data urodzenia:</strong> {{ $staff->date_of_birth }}</p>
            <p class="card-text"><strong>Role:</strong> {{ ucfirst($staff->role->name) ?? 'Brak' }}</p>

            <a href="{{ route('staff.edit', $staff) }}" class="btn btn-warning">Edytuj</a>
            <a href="{{ route('staff.index') }}" class="btn btn-secondary">Powrót</a>
        </div>

        <div class="p-3"> <!-- dodany padding -->
            <strong>Przypisani pacjenci:</strong>

            <table class="table table-bordered table-striped mt-2"> <!-- dodana klasa table-striped -->
                <thead>
                    <tr>
                        <th>Imię i nazwisko</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                    <tr>
                        <td><a href="{{ route('patients.show', $patient) }}">{{ $patient->name }} {{ $patient->s_name }}</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="2">Brak wpisów</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
