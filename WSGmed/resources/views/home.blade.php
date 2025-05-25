@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
            </div>
            <a href="{{route('locations.index')}}">Lokalizacje - Pokoje</a> <br><br>
            <a href="{{route('medications.index')}}">Leki - Spis leków</a> <br><br>
            <a href="{{route('patients.index')}}">Pacjenci - Spis pacjentów</a> <br><br>
            <a href="{{route('emergency_calls.index')}}">Pacjenci - Spis emergency callów</a> <br><br>
        </div>
    </div>
</div>
@endsection
