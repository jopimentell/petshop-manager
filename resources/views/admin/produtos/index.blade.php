{{-- resources/views/admin/produtos/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Produtos - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Produtos</h1>
        <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Produto
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
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th class="text-center">Estoque</th>
                            <th class="text-right">Preço Venda</th>
                            <th class="text-center">Status</th>
                            <th width="15%" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos as $produto)
                        <tr>
                            <td>
                                <strong>{{ $produto->nome }}</strong>
                                @if($produto->descricao)
                                <br><small class="text-muted">{{ Str::limit($produto->descricao, 50) }}</small>
                                @endif
                            </td>
                            <td>{{ $produto->categoria->nome }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $produto->quantidade_estoque <= $produto->estoque_minimo ? 'danger' : 'success' }}">
                                    {{ $produto->quantidade_estoque }}
                                </span>
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ $produto->ativo ? 'success' : 'secondary' }}">
                                    {{ $produto->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.produtos.show', $produto) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.produtos.edit', $produto) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
                                <p class="text-muted">Nenhum produto cadastrado</p>
                                <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary">
                                    Cadastrar primeiro produto
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($produtos->hasPages())
        <div class="card-footer">
            {{ $produtos->links() }}
        </div>
        @endif
    </div>
@stop