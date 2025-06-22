@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodawanie opisu emergencyCalla</h1>

    <form method="POST" action="{{route('emergency_calls.update', $emergency_call)}}">
        @csrf

        @if(isset($emergency_call))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea class="form-control" id="description" name="description" required rows="10">{{ old('description', $emergency_call->description ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Zapisz zmiany</button>
    </form>
</div>

@endsection