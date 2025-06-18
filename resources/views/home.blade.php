@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex flex-wrap justify-content-between align-items-start">
    <div class="row col-md-12 col-lg-6 justify-content-center">

            <h2 class="mb-4">Ostatnio dodane leki</h2>

            @include('medications._list', ['medications' => $medications])

            <div class="mt-3">
                <a href="{{ route('medications.index') }}" class="btn btn-outline-primary">
                    Zobacz wszystkie leki
                </a>
            </div>

    </div>
    <div class="row col-md-12 col-lg-6 justify-content-center">

        <h2 class="mb-4">Ostatnio dodani pacjenci</h2>

        @php($patients = \App\Models\Patient::all())
        @include('patients._list', ['patients' => $patients])


        <div class="mt-3">
            <a href="{{ route('patients.index') }}" class="btn btn-outline-primary">
                Zobacz wszystkich pacjentów
            </a>
        </div>

    </div>

    <div class="row col-md-12 col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Ostatnie zgłoszenia</h4>
                <div class="d-flex py-2 border-bottom">
                    <div class="wrapper">
                        <small class="text-muted">Mar 14, 2019</small>
                        <p class="font-weight-semibold text-gray mb-0">Change in Directors</p>
                    </div>
                    <small class="text-muted ml-auto">Zobacz więcej</small>
                </div>
                <div class="d-flex py-2 border-bottom">
                    <div class="wrapper">
                        <small class="text-muted">Mar 14, 2019</small>
                        <p class="font-weight-semibold text-gray mb-0">Change in Directors</p>
                    </div>
                    <small class="text-muted ml-auto">Zobacz więcej</small>
                </div>
                <div class="d-flex py-2 border-bottom">
                    <div class="wrapper">
                        <small class="text-muted">Mar 14, 2019</small>
                        <p class="font-weight-semibold text-gray mb-0">Change in Directors</p>
                    </div>
                    <small class="text-muted ml-auto">Zobacz więcej</small>
                </div>
                <div class="d-flex py-2 border-bottom">
                    <div class="wrapper">
                        <small class="text-muted">Mar 14, 2019</small>
                        <p class="font-weight-semibold text-gray mb-0">Change in Directors</p>
                    </div>
                    <small class="text-muted ml-auto">Zobacz więcej</small>
                </div>
                <a class="d-block mt-5" href="#">Pokaż wszystkie zgłoszenia</a>
            </div>
        </div>
    </div>
</div>
@endsection
