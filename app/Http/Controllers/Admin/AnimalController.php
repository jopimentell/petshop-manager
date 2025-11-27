<?php
// app/Http/Controllers/Admin/AnimalController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Cliente;
use App\Models\Raca;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animais = Animal::with(['dono', 'raca'])->paginate(10);
        return view('admin.animais.index', compact('animais'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $racas = Raca::all();
        
        return view('admin.animais.create', compact('clientes', 'racas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'dono_id' => 'required|exists:clientes,id',
            'raca_id' => 'required|exists:racas,id',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'required|in:M,F',
            'cor' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ]);

        Animal::create($request->all());

        return redirect()->route('admin.animais.index')
            ->with('success', 'Animal cadastrado com sucesso!');
    }

    public function show(Animal $animal)
    {
        $animal->load(['dono', 'raca', 'agendamentos.servicos', 'agendamentos.user']);
        return view('admin.animais.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        $clientes = Cliente::all();
        $racas = Raca::all();
        
        return view('admin.animais.edit', compact('animal', 'clientes', 'racas'));
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'dono_id' => 'required|exists:clientes,id',
            'raca_id' => 'required|exists:racas,id',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'required|in:M,F',
            'cor' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ]);

        $animal->update($request->all());

        return redirect()->route('admin.animais.index')
            ->with('success', 'Animal atualizado com sucesso!');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('admin.animais.index')
            ->with('success', 'Animal excluído com sucesso!');
    }
}