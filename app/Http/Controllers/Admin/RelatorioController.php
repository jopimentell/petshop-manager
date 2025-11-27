<?php
// app/Http/Controllers/Admin/RelatorioController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Agendamento;
use App\Models\Produto;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('admin.relatorios.index');
    }

    public function vendas(Request $request)
    {
        $query = Venda::with(['cliente', 'user', 'itens.produto']);
        
        if ($request->data_inicio) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }
        
        if ($request->data_fim) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }
        
        $vendas = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin.relatorios.vendas', compact('vendas'));
    }

    public function servicos(Request $request)
    {
        $query = Agendamento::with(['animal.dono', 'servicos', 'user']);
        
        if ($request->data_inicio) {
            $query->whereDate('data_hora', '>=', $request->data_inicio);
        }
        
        if ($request->data_fim) {
            $query->whereDate('data_hora', '<=', $request->data_fim);
        }
        
        $agendamentos = $query->orderBy('data_hora', 'desc')->get();
        
        return view('admin.relatorios.servicos', compact('agendamentos'));
    }
}