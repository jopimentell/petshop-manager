{{-- resources/views/admin/produtos/show.blade.php --}}
@extends('adminlte::page')

@section('title', $produto->nome . ' - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Produto: {{ $produto->nome }}</h1>
        <div>
            <a href="{{ route('admin.produtos.edit', $produto) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-default">
                Voltar
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informações do Produto</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nome:</th>
                            <td>{{ $produto->nome }}</td>
                        </tr>
                        <tr>
                            <th>Categoria:</th>
                            <td>{{ $produto->categoria->nome }}</td>
                        </tr>
                        <tr>
                            <th>Fornecedor:</th>
                            <td>{{ $produto->fornecedor->nome_fantasia ?: $produto->fornecedor->razao_social }}</td>
                        </tr>
                        <tr>
                            <th>Descrição:</th>
                            <td>{{ $produto->descricao ?: 'Nenhuma descrição' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Preços e Estoque</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Preço de Custo:</th>
                            <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Preço de Venda:</th>
                            <td class="font-weight-bold text-success">
                                R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Margem de Lucro:</th>
                            <td class="{{ (($produto->preco_venda - $produto->preco_custo) / $produto->preco_custo * 100) > 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format((($produto->preco_venda - $produto->preco_custo) / $produto->preco_custo * 100), 2, ',', '.') }}%
                            </td>
                        </tr>
                        <tr>
                            <th>Estoque Atual:</th>
                            <td>
                                <span class="badge bg-{{ $produto->quantidade_estoque <= $produto->estoque_minimo ? 'danger' : 'success' }}">
                                    {{ $produto->quantidade_estoque }} unidades
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Estoque Mínimo:</th>
                            <td>{{ $produto->estoque_minimo }} unidades</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $produto->ativo ? 'success' : 'secondary' }}">
                                    {{ $produto->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($produto->quantidade_estoque <= $produto->estoque_minimo)
    <div class="alert alert-warning">
        <i class="icon fas fa-exclamation-triangle"></i>
        <strong>Atenção!</strong> O estoque deste produto está abaixo do mínimo recomendado.
    </div>
    @endif
@stop