@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Szczegóły emergencyCalla</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $emergency_call->patient->name }} {{ $emergency_call->patient->s_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $emergency_call->patient->email }}</p>
            <p class="card-text"><strong>Data urodzenia:</strong> {{ $emergency_call->patient->date_of_birth }}</p>
            <hr>
            <p class="card-text"><strong>Data zdarzenia:</strong> {{ $emergency_call->date}}</p>
            <p class="card-text"><strong>Status zdarzenia:</strong> {{ $emergency_call->status}}</p>
            <p class="card-text"><strong>Opis zdarzenia:</strong> <br>
            <textarea disabled cols="100" rows="10">{{ $emergency_call->description}}</textarea></p>



            <a href="{{ route('emergency_calls.edit', $emergency_call) }}" class="btn btn-warning">Edytuj opis</a>
            <form action="{{ route('emergency_calls.destroy', $emergency_call) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Na pewno usunąć emergency call?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Usuń</button>
            </form>
        </div>

    </div>
</div>
@endsection
