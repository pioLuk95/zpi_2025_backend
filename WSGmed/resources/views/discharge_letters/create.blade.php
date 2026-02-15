@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Stwórz wypis</h2>

    <form action="{{ route('discharge.store', $patient) }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <p><strong>Pacjent:</strong> {{ $patient->name }} {{ $patient->s_name }}</p>
        </div>

        <div class="mb-3">
            <label for="discharge_date">Data wypisu</label>
            <input type="date" name="discharge_date" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>

        Notatki:
       <textarea
        name="discharge_notes"
        id="discharge_notes"
        class="form-control"
        style="resize: both;"
        ></textarea>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary mt-5">Zapisz wypis</button>
    </form>
</div>
@endsection
