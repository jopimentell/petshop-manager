{{-- resources/views/admin/animais/show.blade.php --}}
@extends('adminlte::page')

@section('title', $animal->nome . ' - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Animal: {{ $animal->nome }}</h1>
        <div>
            <a href="{{ route('admin.animais.edit', $animal) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('admin.animais.index') }}" class="btn btn-default">
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
                    <h3 class="card-title">Informações do Animal</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nome:</th>
                            <td>{{ $animal->nome }}</td>
                        </tr>
                        <tr>
                            <th>Dono:</th>
                            <td>
                                <a href="{{ route('admin.clientes.show', $animal->dono) }}">
                                    {{ $animal->dono->nome }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Raça:</th>
                            <td>{{ $animal->raca->nome }} ({{ $animal->raca->especie }})</td>
                        </tr>
                        <tr>
                            <th>Data Nascimento:</th>
                            <td>
                                @if($animal->data_nascimento)
                                    {{ $animal->data_nascimento->format('d/m/Y') }}
                                    ({{ $animal->data_nascimento->age }} anos)
                                @else
                                    Não informada
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sexo:</th>
                            <td>{{ $animal->sexo == 'M' ? 'Macho' : 'Fêmea' }}</td>
                        </tr>
                        <tr>
                            <th>Cor:</th>
                            <td>{{ $animal->cor ?: 'Não informada' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Observações</h3>
                </div>
                <div class="card-body">
                    <p>{{ $animal->observacoes ?: 'Nenhuma observação cadastrada.' }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Histórico de Agendamentos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.agendamentos.create') }}?animal_id={{ $animal->id }}" 
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Novo Agendamento
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($animal->agendamentos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Data/Hora</th>
                                        <th>Serviços</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($animal->agendamentos->sortByDesc('data_hora') as $agendamento)
                                    <tr>
                                        <td>
                                            <small>{{ $agendamento->data_hora->format('d/m/Y') }}</small><br>
                                            <strong>{{ $agendamento->data_hora->format('H:i') }}</strong>
                                        </td>
                                        <td>
                                            @foreach($agendamento->servicos as $servico)
                                                <span class="badge bg-primary">{{ $servico->nome }}</span>
                                            @endforeach
                                        </td>
                                        <td>R$ {{ number_format($agendamento->valor_total, 2, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-{{ 
                                                $agendamento->situacao == 'concluido' ? 'success' : 
                                                ($agendamento->situacao == 'cancelado' ? 'danger' : 'warning')
                                            }}">
                                                {{ $agendamento->situacao }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.agendamentos.show', $agendamento) }}" 
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
                            <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                            <p class="text-muted">Nenhum agendamento registrado</p>
                            <a href="{{ route('admin.agendamentos.create') }}?animal_id={{ $animal->id }}" 
                               class="btn btn-primary btn-sm">
                                Agendar serviço
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop