@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>User details</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p class="card-text"><strong>Id w systemie:</strong> {{ $user->id }}</p>
            <p class="card-text"><strong>Nazwa:</strong> {{ $user->name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Data dołączenia:</strong> {{ $user->created_at}}</p>
            

            <p class="card-text"><strong>2FA Status: {{ ($user->is2FAEnabled()) ? "Enabled" : "Disabled" }}</strong></p>
            <br><br><br>

            @if($user->is2FAEnabled())
                <form id="logout-form" action="{{ route("profile.disable-2fa") }}" method="POST">
                    {{ csrf_field() }}
                    <input type="submit" value="Disable 2FA" class="btn btn-danger w-100 mt-3">
                </form>
            @else
                <p class="card-text"><strong><a href="{{ route("2fa.setup") }}">Enable 2FA</a></strong></p>
            @endif

        </div>
    </div>
</div>
@endsection
