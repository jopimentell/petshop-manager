{{-- resources/views/home.blade.php --}}
@extends('layouts.guest')

@section('title', 'PetShop - Cuidado Premium para seu Pet')
@section('body-class', 'hold-transition')

@section('styles')
<style>
    body {
        background: #fff;
    }

    .navbar {
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        padding: 1rem 0;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 600;
        color: #495057;
    }

    .navbar-brand i {
        color: #3498db;
    }

    .hero-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .hero-content {
        text-align: left;
        padding: 40px 0;
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .hero-content p {
        font-size: 1.1rem;
        color: #546e7a;
        margin-bottom: 2rem;
    }

    .hero-image {
        text-align: center;
    }

    .hero-image img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .features-section {
        padding: 60px 0;
        background: #fff;
    }

    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title h2 {
        font-size: 2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .feature-card {
        text-align: center;
        padding: 2rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        background: #fff;
        border: 1px solid #e9ecef;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: #fff;
    }

    .feature-card.blue .feature-icon {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    }

    .feature-card.orange .feature-icon {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    }

    .feature-card.green .feature-icon {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
    }

    .feature-card h5 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.75rem;
    }

    .feature-card p {
        color: #546e7a;
        margin-bottom: 0;
    }

    footer {
        background: #2c3e50;
        color: #fff;
        padding: 2rem 0;
        text-align: center;
    }

    footer p {
        margin-bottom: 0.5rem;
    }

    .btn-hero {
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2rem;
        }
        
        .hero-section {
            padding: 40px 0;
        }
        
        .hero-content {
            text-align: center;
            padding: 20px 0;
        }
    }
</style>
@endsection

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-heart"></i>
            <b>PetShop</b> Care
        </a>
        
        <div class="ml-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-primary mr-2">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary">
                Cadastrar
            </a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1>Cuidado Premium para seu Pet</h1>
                    <p>Sistema completo de gestão para petshops. Controle consultas, vendas e mantenha o histórico completo dos seus clientes peludos.</p>
                    
                    <div class="d-flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-hero">
                            <i class="fas fa-rocket mr-2"></i>Começar Agora
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-hero ml-2">
                            Fazer Login
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=600&h=400&fit=crop" 
                         alt="Veterinário com pets" 
                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22600%22 height=%22400%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22600%22 height=%22400%22/%3E%3Ctext fill=%22%23999%22 x=%22240%22 y=%22200%22 font-size=%2230%22%3EPet Image%3C/text%3E%3C/svg%3E'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title">
            <h2>Por que escolher nosso sistema?</h2>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card blue">
                    <div class="feature-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h5>Gestão Completa</h5>
                    <p>Controle total de consultas, procedimentos e histórico médico dos pets</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card orange">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5>Agendamento Fácil</h5>
                    <p>Sistema de agendamento intuitivo com lembretes automáticos</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card green">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Dados Seguros</h5>
                    <p>Informações protegidas com backup automático e segurança total</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>
            <i class="fas fa-paw mr-2"></i>
            <b>PetShop</b> - Sistema de gestão para petshops
        </p>
        <p class="small text-muted">
            © 2024 PetShop. Desenvolvido com ❤️ para quem ama animais
        </p>
    </div>
</footer>
@endsection