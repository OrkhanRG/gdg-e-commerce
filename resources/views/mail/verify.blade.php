@extends('layouts.auth')
@section('title', 'Daxil Ol')

@push('css')
@endpush

@section('content')
    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo d-block mb-2">E-<span>Commerce</span></a>
        <h5 class="text-muted fw-normal mb-4">Buradan hesabınızın doğrulanması üşün üçün doğrulama maili göndərə bilərsiniz.</h5>
        <form action="{{ route('verify-mail') }}" method="POST" class="forms-sample formVerify">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email ünvanınız" value="{{ old('email') }}">
            </div>
            <div>
                <a href="javascript:void(0)" class="btn btn-primary me-2 mb-2 mb-md-0 text-white brnVerify">Doğrulama Maili Göndər</a>
            </div>
            <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Hesabınız yoxdur? Qeydiyyat</a>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/auth/verify.js') }}"></script>
@endpush
