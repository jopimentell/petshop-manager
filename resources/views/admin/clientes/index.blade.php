{{-- resources/views/admin/clientes/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Clientes - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Clientes</h1>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Cliente
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
        <div class="card-header">
            <div class="card-tools">
                <form action="{{ route('admin.clientes.index') }}" method="GET" class="form-inline">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th width="5%">ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th width="10%" class="text-center">Animais</th>
                            <th width="15%" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                        <tr>
                            <td>#{{ $cliente->id }}</td>
                            <td>
                                <strong>{{ $cliente->nome }}</strong>
                                @if($cliente->email)
                                <br><small class="text-muted">{{ $cliente->email }}</small>
                                @endif
                            </td>
                            <td>{{ substr($cliente->cpf, 0, 3) }}.***.***-{{ substr($cliente->cpf, -2) }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $cliente->animais_count }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.clientes.show', $cliente) }}" 
                                       class="btn btn-info btn-sm" title="Ver detalhes">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.clientes.edit', $cliente) }}" 
                                       class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.clientes.destroy', $cliente) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                title="Excluir"
                                                onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-users fa-2x text-muted mb-3"></i>
                                <p class="text-muted">Nenhum cliente cadastrado</p>
                                <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">
                                    Cadastrar primeiro cliente
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($clientes->hasPages())
        <div class="card-footer">
            {{ $clientes->links() }}
        </div>
        @endif
    </div>
@stop