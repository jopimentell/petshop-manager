{{-- resources/views/admin/animais/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Novo Animal - PetShop')

@section('content_header')
    <h1>Novo Animal</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.animais.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome do Animal *</label>
                            <input type="text" name="nome" id="nome" 
                                   class="form-control @error('nome') is-invalid @enderror" 
                                   value="{{ old('nome') }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dono_id">Dono *</label>
                            <select name="dono_id" id="dono_id" 
                                    class="form-control @error('dono_id') is-invalid @enderror" required>
                                <option value="">Selecione o dono</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" 
                                        {{ old('dono_id', request('cliente_id')) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }} - {{ $cliente->cpf }}
                                </option>
                                @endforeach
                            </select>
                            @error('dono_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="raca_id">Raça *</label>
                            <select name="raca_id" id="raca_id" 
                                    class="form-control @error('raca_id') is-invalid @enderror" required>
                                <option value="">Selecione a raça</option>
                                @foreach($racas as $raca)
                                <option value="{{ $raca->id }}" {{ old('raca_id') == $raca->id ? 'selected' : '' }}>
                                    {{ $raca->nome }} ({{ $raca->especie }})
                                </option>
                                @endforeach
                            </select>
                            @error('raca_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" 
                                   class="form-control @error('data_nascimento') is-invalid @enderror" 
                                   value="{{ old('data_nascimento') }}">
                            @error('data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sexo">Sexo *</label>
                            <select name="sexo" id="sexo" 
                                    class="form-control @error('sexo') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Macho</option>
                                <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Fêmea</option>
                            </select>
                            @error('sexo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cor">Cor</label>
                            <input type="text" name="cor" id="cor" 
                                   class="form-control @error('cor') is-invalid @enderror" 
                                   value="{{ old('cor') }}">
                            @error('cor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea name="observacoes" id="observacoes" 
                              class="form-control @error('observacoes') is-invalid @enderror" 
                              rows="3">{{ old('observacoes') }}</textarea>
                    @error('observacoes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Animal
                    </button>
                    <a href="{{ route('admin.animais.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop