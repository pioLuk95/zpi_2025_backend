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
                <input type="date" name="insert_date" class="form-control" value="{{ now()->toDateString() }}" required>
            </div>

            {{-- Ciśnienie krwi --}}
            <div class="mb-3">
                <label for="blood_pressure">Ciśnienie krwi</label>
                <input type="text" pattern="[0-9/]*" name="blood_pressure" class="form-control" required>
            </div>

            {{-- Temperatura --}}
            <div class="mb-3">
                <label for="temperature">Temperatura</label>
                <input type="text" pattern="[0-9/.]*" name="temperature" class="form-control" required>
            </div>

            {{-- Tętno --}}
            <div class="mb-3">
                <label for="pulse">Tętno</label>
                <input type="number" name="pulse" class="form-control" required>
            </div>

            {{-- Waga --}}
            <div class="mb-3">
                <label for="weight">Waga</label>
                <input type="number" name="weight" class="form-control" required>
            </div>

            {{-- Nastrój --}}
            <div class="mb-3">
                <label for="mood">Nastrój</label>
                <select name="mood" class="form-select" required>
                    <option value="">-- wybierz nastrój --</option>
                    <option value="very_bad">Bardzo zły</option>
                    <option value="bad">Zły</option>
                    <option value="good">Dobry</option>
                    <option value="very_good">Bardzo dobry</option>
                </select>

            </div>

            {{-- Poziom bólu --}}
            <div class="mb-3">
                <label for="pain_level">Poziom bólu (1-10)</label>
                <input type="text" pattern="[0-9]*" name="pain_level" class="form-control" required>
            </div>

            {{-- Saturacja --}}
            <div class="mb-3">
                <label for="oxygen_saturation">Saturacja</label>
                <input type="text" pattern="[0-9]*" name="oxygen_saturation" class="form-control" required>
            </div>

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
