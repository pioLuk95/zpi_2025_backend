@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($medication) ? 'Edytuj Lek' : 'Dodaj Lek' }}</h1>

    <form method="POST" action="{{ isset($medication) ? route('medications.update', $medication) : route('medications.store') }}">
        @csrf

        @if(isset($medication))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa leku</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $medication->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="info" class="form-label">Info</label>
            <input type="text" class="form-control" id="info" name="info" value="{{ old('info', $medication->info ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($medication) ? 'Zapisz zmiany' : 'Dodaj' }}</button>
    </form>
</div>

@endsection