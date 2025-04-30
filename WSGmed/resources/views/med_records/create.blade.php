@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nowy wpis medyczny</h2>

    <form action="{{ route('medical-records.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <p><strong>Pacjent:</strong> {{ $patient->name }} {{ $patient->s_name }}</p>
        </div>

        <div class="mb-3">
            <label for="record_date">Data wpisu</label>
            <input type="date" name="record_date" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>

        @foreach([
            'blood_pressure' => 'Ciśnienie krwi',
            'temperature' => 'Temperatura',
            'pulse' => 'Tętno',
            'weight' => 'Waga',
            'mood' => 'Nastrój (1-10)',
            'pain_level' => 'Poziom bólu (1-10)',
            'oxygen_saturation' => 'Saturacja'
        ] as $field => $label)
        <div class="mb-3">
            <label for="{{ $field }}">{{ $label }}</label>
            <input type="number" name="{{ $field }}" class="form-control" step="0.01" required>
        </div>
        @endforeach

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Zapisz wpis</button>
    </form>
</div>
@endsection
