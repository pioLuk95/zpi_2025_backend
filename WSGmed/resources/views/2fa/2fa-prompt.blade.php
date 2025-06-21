@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-4 bg-white shadow rounded">
    <h2 class="text-xl mb-4">Enter your PIN from Google Authenticator</h2>
    
    <form method="POST" action="{{ route('2fa.verifyOtp') }}">
        @csrf
        <input type="text" name="otp" maxlength="6" class="input" placeholder="123456" required>
        @error('otp')

            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Zweryfikuj</button>
    </form>
</div>
@endsection
