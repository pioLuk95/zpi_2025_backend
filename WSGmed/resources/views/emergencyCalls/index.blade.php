@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Emergency Calle</h1>

    <a href="{{ route('emergency_calls.create') }}" class="btn btn-primary mb-3">Dodaj nowy wpis</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Data</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Pętla przez emergency calle -->
            @foreach($calls as $call)
            <tr>
                <td>{{ $call->patient->name }} {{ $call->patient->s_name }}</td>
                <td>{{ $call->date }}</td>
                <td>{{ $call->status }}</td>
                <td>
                    <form action="{{ route('emergency_calls.destroy', $call->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection