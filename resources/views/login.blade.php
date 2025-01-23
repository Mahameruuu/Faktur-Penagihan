@extends('layouts.MainLogin')

@section('content')
    <div class="container-fluid h-custom">
        <div class="col-md-6 col-lg-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="Enter a valid email address" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="Enter password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-body">Forgot password?</a>
                </div>

                <div class="text-center mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}"
                            class="link-danger">Register</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
