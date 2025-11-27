{{-- resources/views/admin/vendas/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Vendas - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Vendas</h1>
        <a href="{{ route('admin.vendas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Venda
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
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Data/Hora</th>
                            <th>Cliente</th>
                            <th class="text-center">Itens</th>
                            <th class="text-right">Valor Total</th>
                            <th>Pagamento</th>
                            <th>Status</th>
                            <th width="15%" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendas as $venda)
                        <tr>
                            <td>
                                <small class="text-muted">{{ $venda->created_at->format('d/m/Y') }}</small><br>
                                <strong>{{ $venda->created_at->format('H:i') }}</strong>
                            </td>
                            <td>
                                {{ $venda->cliente ? $venda->cliente->nome : 'Consumidor Final' }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $venda->itens->count() }}</span>
                            </td>
                            <td class="text-right">
                                <strong>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($venda->forma_pagamento) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $venda->status == 'concluida' ? 'success' : 'warning' }}">
                                    {{ $venda->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.vendas.show', $venda) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-2x text-muted mb-3"></i>
                                <p class="text-muted">Nenhuma venda registrada</p>
                                <a href="{{ route('admin.vendas.create') }}" class="btn btn-primary">
                                    Realizar primeira venda
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($vendas->hasPages())
        <div class="card-footer">
            {{ $vendas->links() }}
        </div>
        @endif
    </div>
@stop