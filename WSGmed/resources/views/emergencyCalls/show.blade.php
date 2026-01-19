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
            <p class="card-text"><strong>Data zdarzenia:</strong> {{ $emergency_call->insert_date}}</p>
            <p class="card-text"><strong>Status zdarzenia:</strong> {{ $emergency_call->status_name}}</p>

            <form action="{{ route('emergency_calls.update', $emergency_call) }}" method="POST" class="card-text">
                @csrf
                @method('PUT')

                <select name="status" class="form-select d-inline w-auto">
                    <option value="0" {{ $emergency_call->status == 0 ? 'selected' : '' }}>Nowy</option>
                    <option value="1" {{ $emergency_call->status == 1 ? 'selected' : '' }}>W trakcie</option>
                    <option value="2" {{ $emergency_call->status == 2 ? 'selected' : '' }}>Zakończony</option>
                </select>

                <button type="submit" class="btn btn-warning ms-3">Zmień status</button>
            </form>
            <br>




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
