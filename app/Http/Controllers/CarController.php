<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        // Recupera todos os carros
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        // Exibe a view para criar um novo carro
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Armazena a imagem no diretório 'cars' dentro de 'storage/app/public'
            $imagePath = $request->file('image')->store('cars', 'public');
        }
    
        // Cria o carro com os dados, incluindo o caminho da imagem
        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'year' => $request->year,
            'price' => $request->price,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('cars.index')->with('success', 'Carro criado com sucesso!');
    }
    

    public function edit(Car $car)
    {
        // Exibe a view de edição do carro com os dados do carro atual
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Verificação de imagem
        ]);

        // Se o usuário enviar uma nova imagem, faz o upload da nova imagem
        if ($request->hasFile('image')) {
            // Remove a imagem antiga, se houver
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            // Salva a nova imagem e armazena o caminho
            $car->image = $request->file('image')->store('cars', 'public');
        }

        // Atualiza os dados do carro, exceto a imagem, já que a imagem foi tratada separadamente
        $car->update($request->only('name', 'brand', 'year', 'price'));

        // Redireciona para a lista de carros com uma mensagem de sucesso
        return redirect()->route('cars.index')->with('success', 'Carro atualizado com sucesso!');
    }

    public function destroy(Car $car)
    {
        // Remove a imagem associada ao carro, se houver
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        // Exclui o carro
        $car->delete();

        // Redireciona para a lista de carros com uma mensagem de sucesso
        return redirect()->route('cars.index')->with('success', 'Carro excluído com sucesso!');
    }
}
