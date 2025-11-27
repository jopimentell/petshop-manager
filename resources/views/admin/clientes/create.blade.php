{{-- resources/views/admin/clientes/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Novo Cliente - PetShop')

@section('content_header')
    <h1>Novo Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.clientes.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nome">Nome Completo *</label>
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
                            <label for="cpf">CPF *</label>
                            <input type="text" name="cpf" id="cpf" 
                                   class="form-control @error('cpf') is-invalid @enderror" 
                                   value="{{ old('cpf') }}" required maxlength="11">
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefone">Telefone *</label>
                            <input type="text" name="telefone" id="telefone" 
                                   class="form-control @error('telefone') is-invalid @enderror" 
                                   value="{{ old('telefone') }}" required>
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço *</label>
                    <textarea name="endereco" id="endereco" 
                              class="form-control @error('endereco') is-invalid @enderror" 
                              rows="3" required>{{ old('endereco') }}</textarea>
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Cliente
                    </button>
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
// Máscara para CPF
document.getElementById('cpf').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});
</script>
@stop