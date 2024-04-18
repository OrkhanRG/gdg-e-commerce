@extends('layouts.auth')
@section('title', 'Qeydiyyat')

@push('css')
@endpush

@section('content')
    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo d-block mb-2">E-<span>Commerce</span></a>
        <h5 class="text-muted fw-normal mb-4">Buradan yeni hesab yarada bilərsiniz.</h5>
        <form action="{{ route('register') }}" method="POST" class="forms-sample formRegister">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Ad Soyad">
                @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Email ünvanınız">
                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifrə</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Şifrəniz">
                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Şifrə Təkrar</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation"
                       placeholder="Şifrənizi təkrarlayın">
                @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Məni xatırla
                </label>
            </div>
            <div>
                <a href="javascript:void(0)"
                   class="btn btn-primary text-white me-2 mb-2 mb-md-0 btnRegister">Qeydiyyat</a>
                <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="mdi mdi-google"></i>
                    Google ilə qeydiyyat
                </button>
            </div>
            <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Hesabınız var? Daxil ol</a>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/auth/register.js') }}"></script>
@endpush
