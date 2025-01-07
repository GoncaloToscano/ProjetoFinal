<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Exibir os 4 carros mais recentes na página inicial
    public function publicIndex()
    {
        $recentCars = Car::latest()->take(4)->get();
        return view('welcome', compact('recentCars'));
    }

    // Exibir todos os carros
 // Exibir todos os carros com filtros opcionais
 public function publicCars(Request $request)
 {
     $query = Car::query(); // Inicia a consulta para o modelo Car
 
     // Aplica filtros dinamicamente com base nos parâmetros recebidos
     if ($request->filled('name')) {
         $query->where('name', 'like', '%' . $request->name . '%');
     }
 
     if ($request->filled('brand')) {
         $query->where('brand', 'like', '%' . $request->brand . '%');
     }
 
     if ($request->filled('min_price')) {
         $query->where('price', '>=', $request->min_price);
     }
 
     if ($request->filled('max_price')) {
         $query->where('price', '<=', $request->max_price);
     }
 
     if ($request->filled('fuel_type')) {
         $query->where('fuel', $request->fuel_type);
     }
 
     // Obter os carros filtrados
     $cars = $query->paginate(12); // Paginação
 
     // Obter as marcas distintas
     $brands = Car::select('brand')->distinct()->get();
 
     // Obter todos os modelos, caso você queira mostrar todos os modelos no início
     $models = Car::select('name')->distinct()->get();
 
     // Retornar a view com os carros filtrados, marcas e modelos
     return view('cars.public', compact('cars', 'brands', 'models'));
 }
 


 // modelsbybrand

public function getModelsByBrand(Request $request)
{
    // Verifica se a marca foi passada na requisição
    $brand = $request->input('brand');

    if ($brand) {
        // Busca os modelos da marca selecionada
        $models = Car::where('brand', $brand)->select('name')->distinct()->get();
        return response()->json($models);
    }

    return response()->json([]);
}

    // Exibir lista de carros com imagens
    public function index()
    {
        $cars = Car::with('images')->get();
        return view('cars.index', compact('cars'));

        
    }

    // Exibir formulário de criação de carro
    public function create()
    {
        return view('cars.create');
    }

    // Armazenar um novo carro no banco de dados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'fuel' => 'required|string|max:255', // Combustível
            'kms' => 'required|integer|min:0', // Quilometragem
            'color' => 'required|string|max:255', // Cor
            'power' => 'required|integer|min:0', // Potência
            'engine_capacity' => 'required|integer|min:0', // Cilindrada
            'gearbox' => 'required|string|in:manual,automatica', // Caixa de velocidades
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $car = Car::create([
            'name' => $validatedData['name'],
            'brand' => $validatedData['brand'],
            'year' => $validatedData['year'],
            'price' => $validatedData['price'],
            'fuel' => $validatedData['fuel'],
            'kms' => $validatedData['kms'],
            'color' => $validatedData['color'],
            'power' => $validatedData['power'],
            'engine_capacity' => $validatedData['engine_capacity'],
            'gearbox' => $validatedData['gearbox'],
        ]);

        // Armazenar as imagens se houver
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Carro adicionado com sucesso!');
    }

    // Em CarController.php
    public function show(Car $car)
    {
        // Retorna a view com o carro específico
        return view('cars.show', compact('car'));
    }

    // Mostrar detalhes pelo ID do carro (para o botão "Ver mais")
    public function showById($id)
    {
        // Busca o carro pelo ID
        $car = Car::with('images')->find($id);
    
        // Verifique se o carro foi encontrado
        if (!$car) {
            return redirect()->route('cars.index')->with('error', 'Carro não encontrado');
        }
    
        // Defina a variável $header
        $header = "Detalhes do Veículo";
    
        // Retorna a view com os detalhes do carro
        return view('cars.show', compact('car', 'header'));
    }
    


    // Exibir o formulário de edição de um carro
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Atualizar os dados de um carro
    public function update(Request $request, Car $car)
    {
        // Validar os dados recebidos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'fuel' => 'required|string|max:255',
            'kms' => 'required|integer|min:0',
            'color' => 'required|string|max:255',
            'power' => 'required|integer|min:0',
            'engine_capacity' => 'required|integer|min:0',
            'gearbox' => 'required|string|in:manual,automatica',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        try {
            // Atualizar os dados do carro
            $car->update([
                'name' => $validated['name'],
                'brand' => $validated['brand'],
                'year' => $validated['year'],
                'price' => $validated['price'],
                'fuel' => $validated['fuel'],
                'kms' => $validated['kms'],
                'color' => $validated['color'],
                'power' => $validated['power'],
                'engine_capacity' => $validated['engine_capacity'],
                'gearbox' => $validated['gearbox'],
            ]);
    
            // Salvar imagens, se houver
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('car_images', 'public');
                    $car->images()->create(['path' => $path]);
                }
            }
    
            return redirect()->route('cars.index')->with('success', 'Carro atualizado com sucesso!');
        } catch (\Exception $e) {
            // Registra o erro no log para rastreamento
            \Log::error('Erro ao atualizar o carro: ' . $e->getMessage());
    
            // Retorna um erro detalhado para o usuário
            return back()->withErrors(['error' => 'Ocorreu um erro ao tentar atualizar o carro. ' . $e->getMessage()])->withInput();
        }
    }
    

    // Excluir um carro
    public function destroy(Car $car)
    {
        // Remover as imagens associadas ao carro
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        // Excluir o carro do banco de dados
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Carro excluído com sucesso!');
    }
}
