{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.guest')

@section('title', 'Cadastro - PetShop Care')
@section('body-class', 'register-page')

@section('content')
<div class="register-box" style="width: 500px; margin: 5% auto;">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="pet-icon">
            <i class="fas fa-heart"></i>
        </div>
        <h1>Inscreva-se</h1>
        <p>Crie sua conta e comece a cuidar melhor do seu pet</p>
    </div>

    <!-- Register Card -->
    <div class="card">
        <div class="card-body register-card-body">
            <div class="register-logo mb-4">
                <i class="fas fa-heart"></i>
                <b>PetShop</b> Care
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group mb-3">
                    <input type="text" 
                           id="name"
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Nome completo"
                           value="{{ old('name') }}" 
                           required 
                           autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="email" 
                           id="email"
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Insira seu e-mail pessoal ou de trabalho..."
                           value="{{ old('email') }}" 
                           required>
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

                <!-- Confirm Password -->
                <div class="input-group mb-4">
                    <input type="password" 
                           id="password_confirmation"
                           name="password_confirmation" 
                           class="form-control" 
                           placeholder="Confirme sua senha..."
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <!-- Terms (optional) -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">
                                Concordo com os <a href="#" class="text-link">Termos de Serviço</a> e <a href="#" class="text-link">Política de Privacidade</a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mb-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-user-plus mr-2"></i>Entrar com e-mail
                        </button>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="mb-0">
                        Já tem uma conta? 
                        <a href="{{ route('login') }}" class="text-link">
                            <strong>Faça login</strong>
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
            <small>© 2024 PetShop Care. Sistema de gestão para petshops.</small>
        </p>
        <p class="mb-0">
            <small>Ao continuar com o Google, Apple ou e-mail, você está concordando com os Termos de Serviço e Política de Privacidade</small>
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

    .icheck-primary label {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endsection