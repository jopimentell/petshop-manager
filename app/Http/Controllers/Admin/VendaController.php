<?php
// app/Http/Controllers/Admin/VendaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\ItemVenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'user', 'itens.produto'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::where('ativo', true)
            ->where('quantidade_estoque', '>', 0)
            ->get();
            
        return view('admin.vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $venda = Venda::create([
                'data_hora' => now(),
                'valor_total' => $request->valor_total,
                'forma_pagamento' => $request->forma_pagamento,
                'status' => 'concluida',
                'cliente_id' => $request->cliente_id ?: null,
                'user_id' => Auth::id()
            ]);

            // Criar itens da venda e atualizar estoque
            foreach ($request->itens as $item) {
                ItemVenda::create([
                    'venda_id' => $venda->id,
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'subtotal' => $item['quantidade'] * $item['preco_unitario']
                ]);

                // Atualizar estoque
                $produto = Produto::find($item['produto_id']);
                $produto->decrement('quantidade_estoque', $item['quantidade']);
            }
        });

        return redirect()->route('admin.vendas.index')
            ->with('success', 'Venda realizada com sucesso!');
    }

    public function show(Venda $venda)
    {
        $venda->load(['cliente', 'user', 'itens.produto']);
        return view('admin.vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        // Vendas geralmente não são editáveis após concluídas
        return redirect()->route('admin.vendas.show', $venda)
            ->with('error', 'Vendas concluídas não podem ser editadas.');
    }

    public function update(Request $request, Venda $venda)
    {
        // Vendas geralmente não são editáveis após concluídas
        return redirect()->route('admin.vendas.show', $venda)
            ->with('error', 'Vendas concluídas não podem ser editadas.');
    }

    public function destroy(Venda $venda)
    {
        // Vendas geralmente não são excluídas, apenas canceladas
        return redirect()->route('admin.vendas.show', $venda)
            ->with('error', 'Vendas não podem ser excluídas. Use o cancelamento se necessário.');
    }
}