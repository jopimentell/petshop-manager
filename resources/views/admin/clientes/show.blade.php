{{-- resources/views/admin/clientes/show.blade.php --}}
@extends('adminlte::page')

@section('title', $cliente->nome . ' - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Cliente: {{ $cliente->nome }}</h1>
        <div>
            <a href="{{ route('admin.clientes.edit', $cliente) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('admin.clientes.index') }}" class="btn btn-default">
                Voltar
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informações Pessoais</h3>
                </div>
                <div class="card-body">
                    <p><strong>CPF:</strong> {{ $cliente->cpf }}</p>
                    <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                    <p><strong>E-mail:</strong> {{ $cliente->email ?? 'Não informado' }}</p>
                    <p><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Animais ({{ $cliente->animais->count() }})</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.animais.create') }}?cliente_id={{ $cliente->id }}" 
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Novo Animal
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($cliente->animais->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Raça</th>
                                        <th>Idade</th>
                                        <th>Sexo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cliente->animais as $animal)
                                    <tr>
                                        <td>{{ $animal->nome }}</td>
                                        <td>{{ $animal->raca->nome }}</td>
                                        <td>
                                            @if($animal->data_nascimento)
                                                {{ $animal->data_nascimento->age }} anos
                                            @else
                                                Não informada
                                            @endif
                                        </td>
                                        <td>{{ $animal->sexo == 'M' ? 'Macho' : 'Fêmea' }}</td>
                                        <td>
                                            <a href="{{ route('admin.animais.show', $animal) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-paw fa-2x text-muted mb-2"></i>
                            <p class="text-muted">Nenhum animal cadastrado</p>
                            <a href="{{ route('admin.animais.create') }}?cliente_id={{ $cliente->id }}" 
                               class="btn btn-primary btn-sm">
                                Cadastrar primeiro animal
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop