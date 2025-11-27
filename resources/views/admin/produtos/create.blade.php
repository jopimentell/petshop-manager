{{-- resources/views/admin/produtos/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Novo Produto - PetShop')

@section('content_header')
    <h1>Novo Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.produtos.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nome">Nome do Produto *</label>
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
                            <label for="categoria_id">Categoria *</label>
                            <select name="categoria_id" id="categoria_id" 
                                    class="form-control @error('categoria_id') is-invalid @enderror" required>
                                <option value="">Selecione a categoria</option>
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" 
                              class="form-control @error('descricao') is-invalid @enderror" 
                              rows="2">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="preco_custo">Preço de Custo *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="preco_custo" id="preco_custo" step="0.01" min="0"
                                       class="form-control @error('preco_custo') is-invalid @enderror" 
                                       value="{{ old('preco_custo') }}" required>
                                @error('preco_custo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="preco_venda">Preço de Venda *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="preco_venda" id="preco_venda" step="0.01" min="0"
                                       class="form-control @error('preco_venda') is-invalid @enderror" 
                                       value="{{ old('preco_venda') }}" required>
                                @error('preco_venda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quantidade_estoque">Estoque Atual *</label>
                            <input type="number" name="quantidade_estoque" id="quantidade_estoque" min="0"
                                   class="form-control @error('quantidade_estoque') is-invalid @enderror" 
                                   value="{{ old('quantidade_estoque', 0) }}" required>
                            @error('quantidade_estoque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estoque_minimo">Estoque Mínimo *</label>
                            <input type="number" name="estoque_minimo" id="estoque_minimo" min="0"
                                   class="form-control @error('estoque_minimo') is-invalid @enderror" 
                                   value="{{ old('estoque_minimo', 5) }}" required>
                            @error('estoque_minimo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fornecedor_id">Fornecedor *</label>
                            <select name="fornecedor_id" id="fornecedor_id" 
                                    class="form-control @error('fornecedor_id') is-invalid @enderror" required>
                                <option value="">Selecione o fornecedor</option>
                                @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>
                                    {{ $fornecedor->nome_fantasia ?: $fornecedor->razao_social }}
                                </option>
                                @endforeach
                            </select>
                            @error('fornecedor_id')
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Produto
                    </button>
                    <a href="{{ route('admin.produtos.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
// Calcular margem de lucro automaticamente
document.addEventListener('DOMContentLoaded', function() {
    const precoCusto = document.getElementById('preco_custo');
    const precoVenda = document.getElementById('preco_venda');
    
    function calcularMargem() {
        if (precoCusto.value && precoVenda.value) {
            const custo = parseFloat(precoCusto.value);
            const venda = parseFloat(precoVenda.value);
            const margem = ((venda - custo) / custo * 100).toFixed(2);
            
            // Mostrar margem (opcional)
            console.log('Margem de lucro: ' + margem + '%');
        }
    }
    
    precoCusto.addEventListener('change', calcularMargem);
    precoVenda.addEventListener('change', calcularMargem);
});
</script>
@stop