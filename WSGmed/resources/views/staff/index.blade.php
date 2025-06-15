@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Staff</h1>

    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Dodaj nowego pracownika</a>

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
                    <a href="{{ route('staff.edit', $staffMember) }}" class="btn btn-warning btn-sm">Edytuj</a>
                    <form action="{{ route('staff.destroy', $staffMember) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                    <a href="{{ route('staff.show', $staffMember) }}" class="btn btn-info btn-sm">Szczegóły</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$staff->links('pagination::bootstrap-5')}}
</div>

@endsection
