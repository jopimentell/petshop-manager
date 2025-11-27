{{-- resources/views/admin/animais/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Animais - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Animais</h1>
        <a href="{{ route('admin.animais.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Animal
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
                            <th>Nome</th>
                            <th>Dono</th>
                            <th>Raça</th>
                            <th>Idade</th>
                            <th>Sexo</th>
                            <th width="15%" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($animais as $animal)
                        <tr>
                            <td>
                                <strong>{{ $animal->nome }}</strong>
                                @if($animal->cor)
                                <br><small class="text-muted">{{ $animal->cor }}</small>
                                @endif
                            </td>
                            <td>{{ $animal->dono->nome }}</td>
                            <td>{{ $animal->raca->nome }}</td>
                            <td>
                                @if($animal->data_nascimento)
                                    {{ $animal->data_nascimento->age }} anos
                                @else
                                    Não informada
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $animal->sexo == 'M' ? 'primary' : 'danger' }}">
                                    {{ $animal->sexo == 'M' ? 'Macho' : 'Fêmea' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.animais.show', $animal) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.animais.edit', $animal) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-paw fa-2x text-muted mb-3"></i>
                                <p class="text-muted">Nenhum animal cadastrado</p>
                                <a href="{{ route('admin.animais.create') }}" class="btn btn-primary">
                                    Cadastrar primeiro animal
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($animais->hasPages())
        <div class="card-footer">
            {{ $animais->links() }}
        </div>
        @endif
    </div>
@stop