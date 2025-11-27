{{-- resources/views/admin/vendas/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Nova Venda - PetShop')

@section('content_header')
    <h1>Nova Venda</h1>
@stop

@section('content')
    <div class="row">
        <!-- Lista de Produtos -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produtos Disponíveis</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" id="search-products" class="form-control" placeholder="Buscar produto...">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="row">
                        @foreach($produtos as $produto)
                        @if($produto->ativo && $produto->quantidade_estoque > 0)
                        <div class="col-md-4 mb-3 produto-item" data-nome="{{ strtolower($produto->nome) }}">
                            <div class="card produto-card" data-produto-id="{{ $produto->id }}" 
                                 data-produto-nome="{{ $produto->nome }}" 
                                 data-produto-preco="{{ $produto->preco_venda }}"
                                 data-produto-estoque="{{ $produto->quantidade_estoque }}">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $produto->nome }}</h6>
                                    <p class="card-text text-success font-weight-bold">
                                        R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                                    </p>
                                    <small class="text-muted">
                                        Estoque: {{ $produto->quantidade_estoque }}
                                    </small>
                                    <br>
                                    <button type="button" class="btn btn-primary btn-sm mt-2 add-to-cart">
                                        <i class="fas fa-cart-plus"></i> Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Carrinho de Compras -->
        <div class="col-md-4">
            <form action="{{ route('admin.vendas.store') }}" method="POST" id="venda-form">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Carrinho de Compras</h3>
                    </div>
                    <div class="card-body">
                        <!-- Cliente -->
                        <div class="form-group">
                            <label for="cliente_id">Cliente (Opcional)</label>
                            <select name="cliente_id" id="cliente_id" class="form-control">
                                <option value="">Consumidor Final</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Itens do Carrinho -->
                        <div id="carrinho-itens">
                            <p class="text-muted text-center">Nenhum produto no carrinho</p>
                        </div>

                        <!-- Total -->
                        <div class="form-group">
                            <label for="valor_total">Valor Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="valor_total" id="valor_total" 
                                       class="form-control" value="0" readonly>
                            </div>
                        </div>

                        <!-- Forma de Pagamento -->
                        <div class="form-group">
                            <label for="forma_pagamento">Forma de Pagamento *</label>
                            <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                                <option value="">Selecione...</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="cartao_debito">Cartão Débito</option>
                                <option value="cartao_credito">Cartão Crédito</option>
                                <option value="pix">PIX</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-block" id="finalizar-venda" disabled>
                            <i class="fas fa-check"></i> Finalizar Venda
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carrinho = [];
    const carrinhoItens = document.getElementById('carrinho-itens');
    const valorTotal = document.getElementById('valor_total');
    const finalizarVenda = document.getElementById('finalizar-venda');
    const searchInput = document.getElementById('search-products');

    // Buscar produtos
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.produto-item').forEach(item => {
            const nome = item.getAttribute('data-nome');
            if (nome.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Adicionar ao carrinho
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.produto-card');
            const produtoId = card.getAttribute('data-produto-id');
            const produtoNome = card.getAttribute('data-produto-nome');
            const produtoPreco = parseFloat(card.getAttribute('data-produto-preco'));
            const produtoEstoque = parseInt(card.getAttribute('data-produto-estoque'));

            // Verificar se já está no carrinho
            const itemExistente = carrinho.find(item => item.id === produtoId);
            
            if (itemExistente) {
                if (itemExistente.quantidade < produtoEstoque) {
                    itemExistente.quantidade++;
                } else {
                    alert('Estoque insuficiente!');
                    return;
                }
            } else {
                carrinho.push({
                    id: produtoId,
                    nome: produtoNome,
                    preco: produtoPreco,
                    quantidade: 1,
                    estoque: produtoEstoque
                });
            }

            atualizarCarrinho();
        });
    });

    function atualizarCarrinho() {
        // Limpar carrinho
        carrinhoItens.innerHTML = '';

        if (carrinho.length === 0) {
            carrinhoItens.innerHTML = '<p class="text-muted text-center">Nenhum produto no carrinho</p>';
            finalizarVenda.disabled = true;
            valorTotal.value = '0';
            return;
        }

        // Adicionar itens ao carrinho
        let total = 0;
        carrinho.forEach((item, index) => {
            const subtotal = item.preco * item.quantidade;
            total += subtotal;

            const itemDiv = document.createElement('div');
            itemDiv.className = 'd-flex justify-content-between align-items-center mb-2 p-2 border rounded';
            itemDiv.innerHTML = `
                <div>
                    <small class="font-weight-bold">${item.nome}</small><br>
                    <small class="text-muted">R$ ${item.preco.toFixed(2)} x ${item.quantidade}</small>
                </div>
                <div class="text-right">
                    <strong>R$ ${subtotal.toFixed(2)}</strong>
                    <div class="btn-group btn-group-sm ml-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="alterarQuantidade(${index}, -1)">-</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="alterarQuantidade(${index}, 1)">+</button>
                        <button type="button" class="btn btn-outline-danger" onclick="removerItem(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            carrinhoItens.appendChild(itemDiv);
        });

        // Atualizar total
        valorTotal.value = total.toFixed(2);
        finalizarVenda.disabled = false;

        // Adicionar campos hidden para os itens
        document.querySelectorAll('[name^="itens"]').forEach(el => el.remove());
        
        carrinho.forEach((item, index) => {
            ['produto_id', 'quantidade', 'preco_unitario'].forEach(field => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `itens[${index}][${field}]`;
                input.value = field === 'produto_id' ? item.id : 
                             field === 'quantidade' ? item.quantidade : item.preco;
                document.getElementById('venda-form').appendChild(input);
            });
        });
    }

    window.alterarQuantidade = function(index, change) {
        const item = carrinho[index];
        const novaQuantidade = item.quantidade + change;

        if (novaQuantidade <= 0) {
            removerItem(index);
        } else if (novaQuantidade <= item.estoque) {
            item.quantidade = novaQuantidade;
            atualizarCarrinho();
        } else {
            alert('Estoque insuficiente!');
        }
    };

    window.removerItem = function(index) {
        carrinho.splice(index, 1);
        atualizarCarrinho();
    };
});
</script>
@stop