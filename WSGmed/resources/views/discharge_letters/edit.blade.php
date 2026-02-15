@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edytuj wypis</h2>

    <form action="{{ route('discharge.update', $dischargeLetter) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <input type="hidden" name="patient_id" value="{{ $dischargeLetter->patient->id }}">
            <p><strong>Pacjent:</strong> {{ $dischargeLetter->patient->name }} {{ $dischargeLetter->patient->s_name }}</p>
        </div>

        <div class="mb-3">
            <label for="discharge_date">Data wypisu</label>
            <input type="date" name="discharge_date" class="form-control" value="{{ $dischargeLetter->discharge_date }}" required>
        </div>

        Notatki:
       <textarea
        name="discharge_notes"
        id="discharge_notes"
        class="form-control"
        style="resize: both;"
        >{{ $dischargeLetter->discharge_notes }}</textarea>
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
