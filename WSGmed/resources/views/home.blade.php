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

    <div class="row mt-4 col-md-12 col-lg-6 grid-margin stretch-card">
        <h2>Ostatnie Emergency Calle</h2>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Data</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <!-- Pętla przez emergency calle -->
            @foreach($calls as $call)
                <tr>
                    <td>{{ $call->patient->name }} {{ $call->patient->s_name }}</td>
                    <td>{{ $call->date }}</td>
                    <td>{{ $call->status }}</td>
                    <td>
                        <a href="{{ route('emergency_calls.show', $call) }}" class="mb-3">Pokaż więcej</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('emergency_calls.index') }}" class="btn btn-outline-primary">
                Zobacz wszystkie emergency calle
            </a>
        </div>

    </div>
    <div class="row mt-4 col-md-12 col-lg-6 grid-margin stretch-card">
        <h2>Ostatnio dodany personel</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Data urodzenia</th>
                <th>Email</th>
                <th>Rola</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <!-- Pętla przez staff -->
            @foreach($staff as $staffMember)
                <tr>
                    <td>{{ $staffMember->name }} {{ $staffMember->s_name }}</td>
                    <td>{{ $staffMember->date_of_birth }}</td>
                    <td>{{ $staffMember->email }}</td>
                    <td>{{ ($staffMember->role!=null) ? ucfirst($staffMember->role->name) : "" }}</td>
                    <td>
                        <a href="{{ route('staff.show', $staffMember) }}" class="btn btn-info btn-sm">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('staff.index') }}" class="btn btn-outline-primary">
                Zobacz wszystkich z personelu
            </a>
        </div>

    </div>
</div>
@endsection
