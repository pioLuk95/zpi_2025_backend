@extends('layouts.app') {{-- или любой твой layout --}}

@section('content')
<div class="container">
    <h2>Konfigurowanie uwierzytelniania dwuskładnikowego</h2>

    <p>1. Zeskanuj ten kod QR w aplikacji Google Authenticator:</p>

    <div>
        {!! $qrCode !!}
    </div>

    <p>2. Lub wprowadź ręcznie ten klucz: <strong>{{ $secret }}</strong></p>

    <p>Po dodaniu kliknij przycisk poniżej i wprowadź 6-cyfrowy kod z aplikacji, aby potwierdzić:</p>

    <form method="POST" action="{{ route('2fa.completeSetup') }}">
        @csrf
        <div class="form-group">
            <label for="code">Wprowadź kod</label>
            <input type="text" name="otp" id="otp" class="form-control" required maxlength="6">

        </div>
        <button type="submit" class="btn btn-primary mt-2">Potwierdź</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
    @endif
</div>
@endsection
