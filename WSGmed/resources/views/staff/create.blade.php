@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($staff) ? 'Edytuj Workera' : 'Dodaj Workera' }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ isset($staff) ? route('staff.update', $staff) : route('staff.store') }}">
        @csrf

        @if(isset($staff))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Imię</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $staff->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="s_name" class="form-label">Nazwisko</label>
            <input type="text" class="form-control" id="s_name" name="s_name" value="{{ old('s_name', $staff->s_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $staff->email ?? '') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Data urodzenia</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $staff->date_of_birth ?? '') }}" required>
        </div>

         <div class="mb-3">
            <label for="role_id" class="form-label">Rola</label>
            <select name="role_id" class="form-select" required>
                <option value="">-- wybierz rolę --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" 
                        {{ old('role_id', $staff->role->id ?? '') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">{{ isset($staff) ? 'Zapisz zmiany' : 'Dodaj' }}</button>
    </form>
</div>

@endsection