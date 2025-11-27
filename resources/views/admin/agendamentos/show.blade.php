{{-- resources/views/admin/agendamentos/show.blade.php --}}
@extends('adminlte::page')

@section('title', 'Agendamento #' . $agendamento->id . ' - PetShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Agendamento #{{ $agendamento->id }}</h1>
        <div>
            <a href="{{ route('admin.agendamentos.edit', $agendamento) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('admin.agendamentos.index') }}" class="btn btn-default">
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
                    <h3 class="card-title">Informações do Agendamento</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Data e Hora:</th>
                            <td>
                                <strong>{{ $agendamento->data_hora->format('d/m/Y') }}</strong><br>
                                <span class="text-muted">{{ $agendamento->data_hora->format('H:i') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Animal:</th>
                            <td>
                                <a href="{{ route('admin.animais.show', $agendamento->animal) }}">
                                    {{ $agendamento->animal->nome }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Dono:</th>
                            <td>
                                <a href="{{ route('admin.clientes.show', $agendamento->animal->dono) }}">
                                    {{ $agendamento->animal->dono->nome }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Funcionário:</th>
                            <td>{{ $agendamento->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Situação:</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $agendamento->situacao == 'concluido' ? 'success' : 
                                    ($agendamento->situacao == 'cancelado' ? 'danger' : 
                                    ($agendamento->situacao == 'em_andamento' ? 'info' : 'warning'))
                                }}">
                                    {{ $agendamento->situacao }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Observações</h3>
                </div>
                <div class="card-body">
                    <p>{{ $agendamento->observacoes ?: 'Nenhuma observação registrada.' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Serviços Agendados</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Serviço</th>
                                <th class="text-right">Preço</th>
                                <th>Duração</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendamento->servicos as $servico)
                            <tr>
                                <td>
                                    <strong>{{ $servico->nome }}</strong>
                                    @if($servico->pivot->observacoes)
                                    <br><small class="text-muted">{{ $servico->pivot->observacoes }}</small>
                                    @endif
                                </td>
                                <td class="text-right">
                                    R$ {{ number_format($servico->pivot->preco, 2, ',', '.') }}
                                </td>
                                <td>{{ $servico->duracao_minutos }} min</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-primary">
                                <th>Total</th>
                                <th class="text-right">R$ {{ number_format($agendamento->valor_total, 2, ',', '.') }}</th>
                                <th>
                                    @php
                                        $duracaoTotal = $agendamento->servicos->sum('duracao_minutos');
                                        $horas = floor($duracaoTotal / 60);
                                        $minutos = $duracaoTotal % 60;
                                    @endphp
                                    {{ $horas > 0 ? $horas . 'h ' : '' }}{{ $minutos }}min
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Ações do Agendamento -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ações</h3>
                </div>
                <div class="card-body">
                    <div class="btn-group-vertical w-100">
                        @if($agendamento->situacao == 'agendado')
                        <form action="{{ route('admin.agendamentos.update', $agendamento) }}" method="POST" class="w-100">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="situacao" value="confirmado">
                            <button type="submit" class="btn btn-success btn-block mb-2">
                                <i class="fas fa-check"></i> Confirmar Agendamento
                            </button>
                        </form>
                        @endif

                        @if(in_array($agendamento->situacao, ['agendado', 'confirmado']))
                        <form action="{{ route('admin.agendamentos.update', $agendamento) }}" method="POST" class="w-100">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="situacao" value="em_andamento">
                            <button type="submit" class="btn btn-info btn-block mb-2">
                                <i class="fas fa-play"></i> Iniciar Serviço
                            </button>
                        </form>
                        @endif

                        @if($agendamento->situacao == 'em_andamento')
                        <form action="{{ route('admin.agendamentos.update', $agendamento) }}" method="POST" class="w-100">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="situacao" value="concluido">
                            <button type="submit" class="btn btn-primary btn-block mb-2">
                                <i class="fas fa-flag-checkered"></i> Concluir Serviço
                            </button>
                        </form>
                        @endif

                        @if(in_array($agendamento->situacao, ['agendado', 'confirmado', 'em_andamento']))
                        <form action="{{ route('admin.agendamentos.update', $agendamento) }}" method="POST" class="w-100">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="situacao" value="cancelado">
                            <button type="submit" class="btn btn-danger btn-block" 
                                    onclick="return confirm('Tem certeza que deseja cancelar este agendamento?')">
                                <i class="fas fa-times"></i> Cancelar Agendamento
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop