@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lokalizacje</h1>

    <a href="{{ route('locations.create') }}" class="btn btn-primary mb-3">Dodaj nową lokalizację</a>

    <div class="row">
        @foreach($locations as $location)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pokój {{ $location->room }}</h5>
                    <p class="card-text">
                        <strong>Piętro:</strong> {{ $location->floor }}
                        <strong>Limit miejsc:</strong> {{ $location->limit }}
                    </p>
                    <a href="{{ route('locations.edit', $location) }}" class="btn btn-warning btn-sm">Edytuj</a>
                    <form action="{{ route('locations.destroy', $location) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{$locations->links('pagination::bootstrap-5')}}
</div>
@endsection