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

        Przypisani pacjenci:

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Imię i nazwisko</th>
                    <th>Sala</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                <tr>
                    <td> <a href="{{ route('patients.show', $patient)}}">{{ $patient->name }} {{ $patient->s_name }}</a></td>
                    <td>{{ $patient->location->name }}</td>
                </tr>
                @empty
                <tr><td colspan="10">Brak wpisów</td></tr>
                @endforelse
            </tbody>
        </table>    

    </div>
</div>
@endsection
