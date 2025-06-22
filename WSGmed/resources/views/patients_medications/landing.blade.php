@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Zalecenia - Pacjenci</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Medicaments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->s_name }}</td>
                <td>{{ $patient->email }}</td>
                <td>
                    <form action="{{ route('patients_medications.store', ['patient' => $patient->id]) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <select name="medication_id" class="form-control form-control-sm me-2" required>
                            <option value="">Select Medicament</option>
                            @foreach($medications as $medication)
                                <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="dosage" class="form-control form-control-sm me-2" placeholder="Dose" step="1" min="0" required style="width:90px;">
                        <span class="me-2">mg</span>
                        <button type="submit" class="btn btn-success btn-sm">Assign</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $patients->links('pagination::bootstrap-5') }}

</div>
@endsection
