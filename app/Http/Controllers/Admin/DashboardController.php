<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Animal;
use App\Models\Venda;
use App\Models\Agendamento;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dados = [
            'totalClientes' => Cliente::count(),
            'totalAnimais' => Animal::count(),
            'vendasMes' => Venda::whereMonth('created_at', now()->month)->count(),
            'agendamentosHoje' => Agendamento::whereDate('data_hora', today())->count(),
            'produtosEstoqueBaixo' => Produto::where('quantidade_estoque', '<', DB::raw('estoque_minimo'))->count(),
            'proximosAgendamentos' => Agendamento::with(['animal.dono', 'servicos'])
                ->whereDate('data_hora', '>=', today())
                ->where('situacao', 'agendado')
                ->orderBy('data_hora')
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', $dados);
    }
}