@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Powiązywanie nowej osoby odpowiedzialnej za pacjenta</h2>

    <div class="card mt-3">

        <div class="card-body">
            <form action="{{ route('staff_patients.assign', $patient) }}" method="POST" class="d-inline">
                @csrf
                <select name="staff_id" id="staff_id" class="form-select mb-3">
                <option value="">-- wybierz osobę --</option>
                @foreach ($staff as $staffMember)
                    <option value="{{ $staffMember->id }}">{{ $staffMember->name }} {{ $staffMember->s_name }} | {{ ucfirst($staffMember->role->name) }}</option>
                @endforeach
            </select>
                <button type="submit" class="btn btn-danger">Dodaj</button>
            </form>
            <a href="{{ route('patients.show', $patient) }}" class="btn btn-secondary">Powrót</a>
        </div>     

    </div>
</div>
@endsection
