@extends('layouts.auth')
@section('title', 'Daxil Ol')

@push('css')
@endpush

@section('content')
    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo d-block mb-2">E-<span>Commerce</span></a>
        <h5 class="text-muted fw-normal mb-4">Buradan hesabınıza daxil ola bilərsiniz.</h5>
        <form class="forms-sample">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email ünvanınız">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Şifrəniz">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Məni xatırla
                </label>
            </div>
            <div>
                <a href="javascript:void(0)" class="btn btn-primary me-2 mb-2 mb-md-0 text-white btnLogin">Daxil Ol</a>
                <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="mdi mdi-google"></i>
                    Google ilə daxil ol
                </button>
            </div>
            <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Hesabınız yoxdur? Qeydiyyat</a>
        </form>
    </div>
@endsection

@push('js')
@endpush
