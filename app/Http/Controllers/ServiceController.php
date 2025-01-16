<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all(); // Pega todos os serviços
        return view('services.index', compact('services')); // Retorna a view 'services.index' com os dados
    }

    public function store(Request $request)
    {
        // Validar os dados
        $request->validate([
            'car_model' => 'required|string|max:255',
            'dealership' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'pickup_date' => 'required|date',
            'service' => 'required|string', // Certifique-se de que o campo 'service' é válido
        ]);
    
        // Criar o serviço
        Service::create([
            'car_model' => $request->car_model,
            'dealership' => $request->dealership,
            'delivery_date' => $request->delivery_date,
            'pickup_date' => $request->pickup_date,
            'service' => $request->service, // Aqui estamos enviando o valor de 'service'
        ]);
    
        // Redirecionar ou enviar uma resposta
        return redirect()->route('service.index')->with('success', 'Serviço agendado com sucesso, irás receber uma notificação por email!');
    }

    public function scheduleService(Request $request)
{
    // Validação dos dados recebidos
    $validatedData = $request->validate([
        'car_model' => 'required|string|max:255',
        'dealership' => 'required|string',
        'delivery_date' => 'required|date',
        'pickup_date' => 'required|date',
        'service' => 'required|string',  // Serviço agendado
    ]);

    // Criando o serviço na base de dados
    $service = new Service();
    $service->car_model = $request->car_model;
    $service->dealership = $request->dealership;
    $service->delivery_date = $request->delivery_date;
    $service->pickup_date = $request->pickup_date;
    $service->service = $request->service;
    $service->save();

    // Definindo a mensagem flash para sucesso
    session()->flash('success', 'Serviço agendado com sucesso!');

    // Redirecionando para a página de serviços ou onde você desejar
    return redirect()->route('service.index');
}

    
}
