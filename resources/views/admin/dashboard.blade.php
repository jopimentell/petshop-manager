{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard - PetShop')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <!-- Cards de Estatísticas -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalClientes }}</h3>
                <p>Clientes Cadastrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.clientes.index') }}" class="small-box-footer">
                Ver todos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalAnimais }}</h3>
                <p>Animais Cadastrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-paw"></i>
            </div>
            <a href="{{ route('admin.animais.index') }}" class="small-box-footer">
                Ver todos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $vendasMes }}</h3>
                <p>Vendas este Mês</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ route('admin.vendas.index') }}" class="small-box-footer">
                Ver todas <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $agendamentosHoje }}</h3>
                <p>Agendamentos Hoje</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <a href="{{ route('admin.agendamentos.index') }}" class="small-box-footer">
                Ver todos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Próximos Agendamentos -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Próximos Agendamentos</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.agendamentos.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Novo
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($proximosAgendamentos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Animal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proximosAgendamentos as $agendamento)
                                <tr>
                                    <td>
                                        <small class="text-muted">{{ $agendamento->data_hora->format('d/m') }}</small><br>
                                        <strong>{{ $agendamento->data_hora->format('H:i') }}</strong>
                                    </td>
                                    <td>
                                        {{ $agendamento->animal->nome }}<br>
                                        <small class="text-muted">{{ $agendamento->animal->dono->nome }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $agendamento->situacao == 'agendado' ? 'warning' : 'success' }}">
                                            {{ $agendamento->situacao }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                        <p class="text-muted">Nenhum agendamento futuro</p>
                        <a href="{{ route('admin.agendamentos.create') }}" class="btn btn-primary btn-sm">
                            Agendar agora
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ações Rápidas</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.clientes.create') }}" class="btn btn-app">
                            <i class="fas fa-user-plus"></i> Novo Cliente
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.agendamentos.create') }}" class="btn btn-app">
                            <i class="fas fa-calendar-plus"></i> Novo Agendamento
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.vendas.create') }}" class="btn btn-app">
                            <i class="fas fa-cash-register"></i> Nova Venda
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.produtos.create') }}" class="btn btn-app">
                            <i class="fas fa-box-open"></i> Novo Produto
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estoque Baixo -->
        @if($produtosEstoqueBaixo > 0)
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Alerta de Estoque
                </h3>
            </div>
            <div class="card-body">
                <p>{{ $produtosEstoqueBaixo }} produto(s) com estoque baixo</p>
                <a href="{{ route('admin.produtos.index') }}" class="btn btn-warning btn-sm">
                    Ver produtos
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@stop

@section('css')
<style>
.btn-app {
    margin: 0;
    border-radius: 3px;
    position: relative;
    padding: 15px 5px;
    margin: 0 0 10px 10px;
    min-width: 80px;
    height: 60px;
    text-align: center;
    color: #666;
    border: 1px solid #ddd;
    background-color: #f4f4f4;
    font-size: 12px;
}
.btn-app:hover {
    background: #f4f4f4;
    border-color: #aaa;
}
</style>
@stop