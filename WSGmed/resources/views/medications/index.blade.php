@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Leki</h1>

    <a href="{{ route('medications.create') }}" class="btn btn-primary mb-3">Dodaj nowy lek</a>

    <div class="row">
        @foreach($medications as $medication)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $medication->name }}</h5>
                    <p class="card-text">
                        <strong>Opis:</strong> {{ $medication->info }}
                    </p>
                    <a href="{{ route('medications.edit', $medication) }}" class="btn btn-warning btn-sm">Edytuj</a>
                    <form action="{{ route('medications.destroy', $medication) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection