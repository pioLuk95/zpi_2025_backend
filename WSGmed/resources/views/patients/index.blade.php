@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pacjenci</h1>

    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Dodaj nowego pacjenta</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Status</th>
                <th>Data urodzenia</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <!-- Pętla przez pacjentów -->
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->name }} {{ $patient->s_name }}</td>
                <td>{{ $patient->status }}</td>
                <td>{{ $patient->date_of_birth }}</td>

                <td>
                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning btn-sm">Edytuj</a>
                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                    <a href="{{ route('patients.show', $patient) }}" class="btn btn-info btn-sm">Szczegóły</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$patients->links('pagination::bootstrap-5')}}
</div>

@endsection
