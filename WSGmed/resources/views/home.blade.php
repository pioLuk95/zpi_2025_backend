@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-between">
    <div class="row col-md-6 justify-content-center">

            <h2 class="mb-4">Ostatnie 5 leków</h2>

            @include('medications._list', ['medications' => $medications])

            <div class="mt-3">
                <a href="{{ route('medications.index') }}" class="btn btn-outline-primary">
                    Zobacz wszystkie leki
                </a>
            </div>
    </div>
    <div class="row col-md-6 justify-content-center">

        <h2 class="mb-4">Ostatnie 5 leków</h2>

        @include('medications._list', ['medications' => $medications])

        <div class="mt-3">
            <a href="{{ route('medications.index') }}" class="btn btn-outline-primary">
                Zobacz wszystkie leki
            </a>
        </div>

    </div>
</div>
@endsection
