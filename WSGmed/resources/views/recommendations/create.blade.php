@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nowe zalecenia</h2>

    <form action="{{ route('recommendations.store', $patient) }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <p><strong>Pacjent:</strong> {{ $patient->name }} {{ $patient->s_name }}</p>
        </div>

        <div class="mb-3">
            <label for="record_date">Data wpisu</label>
            <input type="date" name="date" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>

       <textarea
        name="text"
        id="text"
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

        <button type="submit" class="btn btn-primary mt-5">Zapisz zalecenie</button>
    </form>
</div>
@endsection
