@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Zarządzanie rolami użytkowników</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Email</th>
                        <th>Obecna rola</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'staff')
                                <span class="badge bg-primary">Staff</span>
                            @elseif($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-success">Patient</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('roles.update', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-select form-select-sm d-inline-block w-auto me-2">
                                    <option value="patient" {{ $user->role === 'patient' ? 'selected' : '' }}>Patient</option>
                                    <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Zmień rolę</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">Brak użytkowników</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Powrót</a>
</div>
@endsection 