@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-shield-lock"></i> Konfigurowanie uwierzytelniania dwuskładnikowego
                    </h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong><i class="bi bi-info-circle"></i> Krok 1:</strong> Zeskanuj kod QR w aplikacji Google Authenticator lub wprowadź klucz ręcznie.
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-center mb-4">
                            <h5 class="mb-3">Kod QR</h5>
                            <div class="border rounded p-3 bg-light d-inline-block">
                                {!! $qrCode !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Klucz ręczny</h5>
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" 
                                       class="form-control form-control-lg text-center font-monospace fw-bold fs-4" 
                                       value="{{ $secret }}" 
                                       id="secretKey" 
                                       readonly
                                       style="letter-spacing: 2px;">
                                <button class="btn btn-outline-secondary btn-lg" type="button" onclick="copySecret()">
                                    <i class="bi bi-clipboard"></i> Kopiuj
                                </button>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Użyj tego klucza, jeśli nie możesz zeskanować kodu QR.
                            </small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-warning">
                        <strong><i class="bi bi-exclamation-triangle"></i> Krok 2:</strong> Po dodaniu konta w aplikacji, wprowadź 6-cyfrowy kod weryfikacyjny poniżej.
                    </div>

                    <form method="POST" action="{{ route('2fa.completeSetup') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label fw-bold">Kod weryfikacyjny</label>
                            <input type="text" 
                                   name="otp" 
                                   id="otp" 
                                   class="form-control form-control-lg text-center font-monospace" 
                                   placeholder="000000"
                                   required 
                                   maxlength="6"
                                   pattern="[0-9]{6}"
                                   autocomplete="off">
                            <small class="form-text text-muted">Wprowadź 6-cyfrowy kod z aplikacji Google Authenticator</small>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Potwierdź i aktywuj 2FA
                            </button>
                        </div>
                    </form>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <i class="bi bi-exclamation-circle"></i> <strong>Błąd:</strong> {{ $errors->first() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copySecret() {
    const secretInput = document.getElementById('secretKey');
    secretInput.select();
    secretInput.setSelectionRange(0, 99999);
    document.execCommand('copy');
    
    const btn = event.target.closest('button');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check"></i> Skopiowano!';
    btn.classList.remove('btn-outline-secondary');
    btn.classList.add('btn-success');
    
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.classList.remove('btn-success');
        btn.classList.add('btn-outline-secondary');
    }, 2000);
}

// Auto-focus i formatowanie pola OTP
document.getElementById('otp').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
@endsection
