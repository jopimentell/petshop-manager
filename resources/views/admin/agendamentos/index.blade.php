{{-- resources/views/admin/agendamentos/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Agendamentos - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Agendamentos</h1>
        <a href="{{ route('admin.agendamentos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Agendamento
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
                <div class="btn-group">
                    <a href="{{ route('admin.agendamentos.index') }}?filter=hoje" 
                       class="btn btn-sm btn-{{ request('filter') == 'hoje' ? 'primary' : 'default' }}">
                        Hoje
                    </a>
                    <a href="{{ route('admin.agendamentos.index') }}?filter=futuro" 
                       class="btn btn-sm btn-{{ request('filter') == 'futuro' ? 'primary' : 'default' }}">
                        Futuros
                    </a>
                    <a href="{{ route('admin.agendamentos.index') }}?filter=passado" 
                       class="btn btn-sm btn-{{ request('filter') == 'passado' ? 'primary' : 'default' }}">
                        Passados
                    </a>
                    <a href="{{ route('admin.agendamentos.index') }}" 
                       class="btn btn-sm btn-{{ !request('filter') ? 'primary' : 'default' }}">
                        Todos
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Data/Hora</th>
                            <th>Animal</th>
                            <th>Dono</th>
                            <th>Serviços</th>
                            <th class="text-right">Valor</th>
                            <th>Status</th>
                            <th width="15%" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendamentos as $agendamento)
                        <tr>
                            <td>
                                <small class="text-muted">{{ $agendamento->data_hora->format('d/m/Y') }}</small><br>
                                <strong>{{ $agendamento->data_hora->format('H:i') }}</strong>
                            </td>
                            <td>{{ $agendamento->animal->nome }}</td>
                            <td>{{ $agendamento->animal->dono->nome }}</td>
                            <td>
                                @foreach($agendamento->servicos as $servico)
                                    <span class="badge bg-primary">{{ $servico->nome }}</span>
                                @endforeach
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($agendamento->valor_total, 2, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                    $agendamento->situacao == 'concluido' ? 'success' : 
                                    ($agendamento->situacao == 'cancelado' ? 'danger' : 
                                    ($agendamento->situacao == 'em_andamento' ? 'info' : 'warning'))
                                }}">
                                    {{ $agendamento->situacao }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.agendamentos.show', $agendamento) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.agendamentos.edit', $agendamento) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                                <p class="text-muted">Nenhum agendamento encontrado</p>
                                <a href="{{ route('admin.agendamentos.create') }}" class="btn btn-primary">
                                    Fazer primeiro agendamento
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($agendamentos->hasPages())
        <div class="card-footer">
            {{ $agendamentos->links() }}
        </div>
        @endif
    </div>
@stop