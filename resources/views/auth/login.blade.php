{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.guest')

@section('title', 'Login - PetShop')
@section('body-class', 'login-page')

@section('content')
<div class="login-box" style="width: 400px; margin: 5% auto;">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="pet-icon">
            <i class="fas fa-heart"></i>
        </div>
        <h1>Bem-vindo(a) de volta!</h1>
        <p>Faça login para acessar sua conta</p>
    </div>

    <!-- Login Card -->
    <div class="card">
        <div class="card-body login-card-body">
            <div class="login-logo mb-4">
                <i class="fas fa-heart"></i>
                <b>PetShop</b> Care
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="email" 
                           id="email"
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Insira seu e-mail..."
                           value="{{ old('email') }}" 
                           required 
                           autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password" 
                           id="password"
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Insira sua senha..."
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Lembrar de mim
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mb-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </div>
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-center mb-3">
                        <a href="{{ route('password.request') }}" class="text-link">
                            Esqueceu sua senha?
                        </a>
                    </div>
                @endif

                <!-- Register Link -->
                <div class="text-center">
                    <p class="mb-0">
                        Não tem uma conta? 
                        <a href="{{ route('register') }}" class="text-link">
                            <strong>Cadastre-se</strong>
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4" style="color: #6c757d;">
        <p class="mb-1">
            <i class="fas fa-paw mr-1"></i>
            <small>© PetShop. Sistema de gestão para petshops.</small>
        </p>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* iCheck for Bootstrap */
    .icheck-primary > input:first-child:checked + label::before {
        background-color: #3498db;
        border-color: #3498db;
    }
    
    .icheck-primary > input:first-child:checked + label::after {
        border-bottom: 2px solid #fff;
        border-right: 2px solid #fff;
    }
</style>
@endsection