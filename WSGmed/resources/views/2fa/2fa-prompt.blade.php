@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-shield-lock"></i> Weryfikacja dwuskładnikowa
                    </h3>
                    <p class="mb-0 mt-2 small opacity-75">Wprowadź kod z aplikacji Google Authenticator</p>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-phone" style="font-size: 3rem; color: #0d6efd;"></i>
                        </div>
                        <p class="text-muted">Otwórz aplikację Google Authenticator na swoim urządzeniu i wprowadź 6-cyfrowy kod weryfikacyjny.</p>
                    </div>

                    <form method="POST" action="{{ route('2fa.verifyOtp') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="otp" class="form-label fw-bold">Kod weryfikacyjny</label>
                            <input type="text" 
                                   name="otp" 
                                   id="otp" 
                                   maxlength="6" 
                                   class="form-control form-control-lg text-center font-monospace" 
                                   placeholder="000000"
                                   required
                                   pattern="[0-9]{6}"
                                   autocomplete="off"
                                   autofocus>
                            <small class="form-text text-muted d-block mt-2 text-center">
                                <i class="bi bi-info-circle"></i> Wprowadź 6-cyfrowy kod z aplikacji
                            </small>
                        </div>

                        @error('otp')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-circle"></i> <strong>Błąd:</strong> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Zweryfikuj i kontynuuj
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <small class="text-muted">
                            <i class="bi bi-question-circle"></i> Nie masz dostępu do aplikacji? 
                            <a href="{{ route('logout') }}" class="text-decoration-none">Skontaktuj się z administratorem</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-focus i formatowanie pola OTP
document.getElementById('otp').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    
    // Automatyczne przejście do weryfikacji po wprowadzeniu 6 cyfr
    if (this.value.length === 6) {
        // Opcjonalnie: automatyczne wysłanie formularza
        // this.form.submit();
    }
});

// Fokus na polu przy załadowaniu strony
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('otp').focus();
});
</script>
@endsection
