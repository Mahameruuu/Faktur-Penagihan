@extends('layouts.MainLogin');

@section('content')
    <div class="container-fluid h-custom">
        <div class="col-md-6 col-lg-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                        placeholder="Enter your name" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="Enter a valid email address" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="Enter password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control form-control-lg" placeholder="Confirm your password" required>
                </div>

                <!-- Submit button -->
                <div class="text-center mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="{{ route('login') }}"
                            class="link-danger">Login</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection