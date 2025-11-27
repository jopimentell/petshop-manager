<?php
// app/Http/Controllers/Admin/AgendamentoController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\Animal;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Agendamento::with(['animal.dono', 'servicos', 'user']);
        
        // Filtros
        if ($request->filter == 'hoje') {
            $query->whereDate('data_hora', today());
        } elseif ($request->filter == 'futuro') {
            $query->whereDate('data_hora', '>=', today());
        } elseif ($request->filter == 'passado') {
            $query->whereDate('data_hora', '<', today());
        }
        
        $agendamentos = $query->orderBy('data_hora')->paginate(10);
        
        return view('admin.agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $animais = Animal::with('dono')->get();
        $servicos = Servico::where('ativo', true)->get();
        
        return view('admin.agendamentos.create', compact('animais', 'servicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animais,id',
            'data_hora' => 'required|date',
            'servicos' => 'required|array|min:1',
            'servicos.*' => 'exists:servicos,id',
            'situacao' => 'required|in:agendado,confirmado,em_andamento,concluido,cancelado,nao_compareceu',
            'valor_total' => 'required|numeric|min:0',
            'observacoes' => 'nullable|string'
        ]);

        $agendamento = Agendamento::create([
            'animal_id' => $request->animal_id,
            'data_hora' => $request->data_hora,
            'situacao' => $request->situacao,
            'valor_total' => $request->valor_total,
            'observacoes' => $request->observacoes,
            'user_id' => Auth::id()
        ]);

        // Adicionar serviços
        $servicosData = [];
        foreach ($request->servicos as $servicoId) {
            $servico = Servico::find($servicoId);
            $servicosData[$servicoId] = ['preco' => $servico->preco];
        }
        
        $agendamento->servicos()->attach($servicosData);

        return redirect()->route('admin.agendamentos.index')
            ->with('success', 'Agendamento criado com sucesso!');
    }

    public function show(Agendamento $agendamento)
    {
        $agendamento->load(['animal.dono', 'servicos', 'user']);
        return view('admin.agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        $animais = Animal::with('dono')->get();
        $servicos = Servico::where('ativo', true)->get();
        $agendamento->load('servicos');
        
        return view('admin.agendamentos.edit', compact('agendamento', 'animais', 'servicos'));
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        if ($request->has('situacao')) {
            // Atualização simples de status
            $agendamento->update(['situacao' => $request->situacao]);
            return redirect()->route('admin.agendamentos.show', $agendamento)
                ->with('success', 'Status do agendamento atualizado!');
        }

        $request->validate([
            'animal_id' => 'required|exists:animais,id',
            'data_hora' => 'required|date',
            'servicos' => 'required|array|min:1',
            'servicos.*' => 'exists:servicos,id',
            'situacao' => 'required|in:agendado,confirmado,em_andamento,concluido,cancelado,nao_compareceu',
            'valor_total' => 'required|numeric|min:0',
            'observacoes' => 'nullable|string'
        ]);

        $agendamento->update([
            'animal_id' => $request->animal_id,
            'data_hora' => $request->data_hora,
            'situacao' => $request->situacao,
            'valor_total' => $request->valor_total,
            'observacoes' => $request->observacoes
        ]);

        // Atualizar serviços
        $servicosData = [];
        foreach ($request->servicos as $servicoId) {
            $servico = Servico::find($servicoId);
            $servicosData[$servicoId] = ['preco' => $servico->preco];
        }
        
        $agendamento->servicos()->sync($servicosData);

        return redirect()->route('admin.agendamentos.index')
            ->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy(Agendamento $agendamento)
    {
        $agendamento->servicos()->detach();
        $agendamento->delete();
        
        return redirect()->route('admin.agendamentos.index')
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}