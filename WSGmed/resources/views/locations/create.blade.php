@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($location) ? 'Edytuj Lokalizację' : 'Dodaj Lokalizację' }}</h1>

    <form method="POST" action="{{ isset($location) ? route('locations.update', $location) : route('locations.store') }}">
        @csrf

        @if(isset($location))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="room" class="form-label">Numer pokoju</label>
            <input type="text" class="form-control" id="room" name="room" value="{{ old('room', $location->room ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="floor" class="form-label">Piętro</label>
            <input type="text" class="form-control" id="floor" name="floor" value="{{ old('floor', $location->floor ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="limit" class="form-label">Limit</label>
            <input type="text" class="form-control" id="limit" name="limit" value="{{ old('limit', $location->limit ?? '') }}" required>
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

        <button type="submit" class="btn btn-success">{{ isset($location) ? 'Zapisz zmiany' : 'Dodaj' }}</button>
    </form>
</div>
@endsection