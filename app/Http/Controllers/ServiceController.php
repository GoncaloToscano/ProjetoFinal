<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Lado do Cliente: Visualização de Serviços
    public function index()
    {
        $services = Service::all(); // Pega todos os serviços
        return view('services.index', compact('services')); // Retorna a view 'services.index' com os dados
    }

    // Lado do Cliente: Agendar um Serviço (já existente)
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

    // Administração: Listar Serviços
    public function adminIndex(Request $request) // Adicionar o Request aqui
    {
        $query = Service::query();

        // Verificar se o parâmetro de pesquisa foi enviado
        if ($request->has('search') && $request->search) {
            // Filtrar com base nos campos desejados
            $query->where('car_model', 'like', '%' . $request->search . '%')
                  ->orWhere('dealership', 'like', '%' . $request->search . '%')
                  ->orWhere('service', 'like', '%' . $request->search . '%');
        }

        // Paginação com os dados filtrados
        $services = $query->paginate(10);
        
        // Retorna a view com os dados dos serviços
        return view('services.admin-index', compact('services'));
    }

    // Administração: Criar Serviço
    public function create()
    {
        return view('services.admin-create');
    }

    // Administração: Salvar Serviço
    public function storeAdmin(Request $request)
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
        return redirect()->route('admin.services.index')->with('success', 'Serviço agendado com sucesso!');
    }

    // Administração: Editar Serviço
    public function edit(Service $service)
    {
        return view('services.admin-edit', compact('service')); // Retorna a view de edição com os dados do serviço
    }

    // Administração: Atualizar Serviço
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'car_model' => 'required|string|max:255',
            'dealership' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'pickup_date' => 'required|date',
            'service' => 'required|string', // Certifique-se de que o campo 'service' é válido
        ]);

        // Atualizando os dados do serviço
        $service->update([
            'car_model' => $request->car_model,
            'dealership' => $request->dealership,
            'delivery_date' => $request->delivery_date,
            'pickup_date' => $request->pickup_date,
            'service' => $request->service, // Aqui estamos enviando o valor de 'service'
        ]);
    
        // Redirecionar ou enviar uma resposta
        return redirect()->route('admin.services.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    // Administração: Remover Serviço
    public function destroy(Service $service)
    {
        $service->delete(); // Deleta o serviço
        return redirect()->route('admin.services.index')->with('success', 'Serviço removido com sucesso!');
    }
}
