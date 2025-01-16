@extends('layouts.app') <!-- Ajuste se necessário para a sua estrutura de layout -->

@section('content')
    <h2>Agendar Serviço</h2>
    <form action="{{ route('service.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="service">Escolha o Serviço</label>
            <select name="service" id="service" class="form-control" required>
                <option value="pneus">Troca de Pneus</option>
                <option value="oleo">Troca de Óleo</option>
                <option value="revisao">Revisão Completa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="car_model">Modelo do Carro</label>
            <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Informe o modelo do seu carro" required>
        </div>
        <div class="form-group">
            <label for="dealership">Concessionária</label>
            <select name="dealership" id="dealership" class="form-control" required>
                <option value="setubal">Setúbal</option>
                <option value="porto">Porto</option>
            </select>
        </div>
        <div class="form-group">
            <label for="delivery_date">Data de Entrega</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
        </div>
        <div class="form-group">
            <label for="pickup_date">Data de Recolha</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Confirmar Agendamento</button>
        </div>
    </form>
@endsection
