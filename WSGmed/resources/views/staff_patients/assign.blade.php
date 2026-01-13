@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Powiązywanie nowej osoby odpowiedzialnej za pacjenta</h2>

        <div class="card mt-3">
            <div class="card-body">

                <form action="{{ route('staff_patients.assign', $patient) }}" method="POST" class="d-inline">
                    @csrf

                    {{-- SELECT 1: wybór roli --}}
                    <select id="role_select" class="form-select mb-3">
                        <option value="">-- wybierz rolę --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>

                    {{-- SELECT 2: wybór osoby --}}
                    <select name="staff_id" id="staff_select" class="form-select mb-3">
                        <option value="">-- wybierz osobę --</option>
                        @foreach ($staff as $staffMember)
                            <option value="{{ $staffMember->id }}" data-role="{{ $staffMember->role_id }}">
                                {{ $staffMember->name }} {{ $staffMember->s_name }} | {{ ucfirst($staffMember->role->name) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-danger">Dodaj</button>
                </form>

                <a href="{{ route('patients.show', $patient) }}" class="btn btn-secondary">Powrót</a>
            </div>
        </div>
    </div>

    {{-- FILTROWANIE JS --}}
    <script>
        document.getElementById('role_select').addEventListener('change', function () {
            const selectedRole = this.value;
            const staffOptions = document.querySelectorAll('#staff_select option');

            staffOptions.forEach(option => {
                if (option.value === "") {
                    option.style.display = "block";
                    return;
                }

                if (!selectedRole || option.dataset.role === selectedRole) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });

            document.getElementById('staff_select').value = "";
        });
    </script>

@endsection
