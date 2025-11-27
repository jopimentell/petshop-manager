{{-- resources/views/admin/agendamentos/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Novo Agendamento - PetShop')

@section('content_header')
    <h1>Novo Agendamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.agendamentos.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="animal_id">Animal *</label>
                            <select name="animal_id" id="animal_id" 
                                    class="form-control @error('animal_id') is-invalid @enderror" required>
                                <option value="">Selecione o animal</option>
                                @foreach($animais as $animal)
                                <option value="{{ $animal->id }}" 
                                        {{ old('animal_id', request('animal_id')) == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->nome }} ({{ $animal->dono->nome }})
                                </option>
                                @endforeach
                            </select>
                            @error('animal_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_hora">Data e Hora *</label>
                            <input type="datetime-local" name="data_hora" id="data_hora" 
                                   class="form-control @error('data_hora') is-invalid @enderror" 
                                   value="{{ old('data_hora') }}" required>
                            @error('data_hora')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Serviços *</label>
                    <div class="row">
                        @foreach($servicos as $servico)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="servicos[]" value="{{ $servico->id }}" 
                                       id="servico_{{ $servico->id }}" 
                                       class="form-check-input servico-checkbox"
                                       {{ in_array($servico->id, old('servicos', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="servico_{{ $servico->id }}">
                                    {{ $servico->nome }} - R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('servicos')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="situacao">Situação</label>
                            <select name="situacao" id="situacao" 
                                    class="form-control @error('situacao') is-invalid @enderror">
                                <option value="agendado" {{ old('situacao', 'agendado') == 'agendado' ? 'selected' : '' }}>Agendado</option>
                                <option value="confirmado" {{ old('situacao') == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                            </select>
                            @error('situacao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valor_total">Valor Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="valor_total" id="valor_total" step="0.01" min="0"
                                       class="form-control @error('valor_total') is-invalid @enderror" 
                                       value="{{ old('valor_total', 0) }}" readonly>
                                @error('valor_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
                        <i class="fas fa-save"></i> Salvar Agendamento
                    </button>
                    <a href="{{ route('admin.agendamentos.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const servicos = @json($servicos->keyBy('id'));
    const checkboxes = document.querySelectorAll('.servico-checkbox');
    const valorTotal = document.getElementById('valor_total');
    
    function calcularTotal() {
        let total = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const servicoId = checkbox.value;
                total += parseFloat(servicos[servicoId].preco);
            }
        });
        valorTotal.value = total.toFixed(2);
    }
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calcularTotal);
    });
    
    // Calcular total inicial
    calcularTotal();
});
</script>
@stop