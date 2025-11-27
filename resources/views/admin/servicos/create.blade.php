{{-- resources/views/admin/servicos/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Novo Serviço - PetShop')

@section('content_header')
    <h1>Novo Serviço</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.servicos.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nome">Nome do Serviço *</label>
                            <input type="text" name="nome" id="nome" 
                                   class="form-control @error('nome') is-invalid @enderror" 
                                   value="{{ old('nome') }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="preco">Preço *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="preco" id="preco" step="0.01" min="0"
                                       class="form-control @error('preco') is-invalid @enderror" 
                                       value="{{ old('preco') }}" required>
                                @error('preco')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duracao_minutos">Duração (minutos) *</label>
                            <input type="number" name="duracao_minutos" id="duracao_minutos" min="1"
                                   class="form-control @error('duracao_minutos') is-invalid @enderror" 
                                   value="{{ old('duracao_minutos', 60) }}" required>
                            @error('duracao_minutos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ativo">Status</label>
                            <select name="ativo" id="ativo" 
                                    class="form-control @error('ativo') is-invalid @enderror">
                                <option value="1" {{ old('ativo', 1) ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ !old('ativo', 1) ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('ativo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" 
                              class="form-control @error('descricao') is-invalid @enderror" 
                              rows="3">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Serviço
                    </button>
                    <a href="{{ route('admin.servicos.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop