{{-- resources/views/admin/servicos/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Serviços - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Serviços</h1>
        <a href="{{ route('admin.servicos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Serviço
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach($servicos as $servico)
                <div class="col-md-4">
                    <div class="card card-{{ $servico->ativo ? 'primary' : 'secondary' }} card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ $servico->nome }}</h3>
                            <div class="card-tools">
                                <span class="badge bg-{{ $servico->ativo ? 'success' : 'secondary' }}">
                                    {{ $servico->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $servico->descricao ?: 'Sem descrição' }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-primary">
                                    R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                </strong>
                                <small class="text-muted">
                                    {{ $servico->duracao_minutos }} min
                                </small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group">
                                <a href="{{ route('admin.servicos.edit', $servico) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop