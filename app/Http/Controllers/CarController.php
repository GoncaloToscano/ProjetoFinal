<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // No seu CarController, a função publicIndex
    public function publicIndex()
    {
        // Buscar os 4 carros mais recentes
        $recentCars = Car::latest()->take(4)->get(); 

        // Passar os carros para a view
        return view('welcome', compact('recentCars'));
    }


    // Método para exibir todos os carros (pode ser usado para a página de administração)
    public function index()
    {
        // Buscar todos os carros no banco de dados
        $cars = Car::all();

        // Retornar a view com todos os carros
        return view('cars.index', compact('cars'));
    }

    // Método para exibir o formulário de criação de um carro
    public function create()
    {
        // Exibe a view para criar um novo carro
        return view('cars.create');
    }

    // Método para armazenar um novo carro no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Verifique se a imagem foi enviada
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

        // Redireciona para a lista de carros com uma mensagem de sucesso
        return redirect()->route('cars.index')->with('success', 'Carro criado com sucesso!');
    }

    // Método para exibir o formulário de edição de um carro
    public function edit(Car $car)
    {
        // Exibe a view de edição do carro com os dados do carro atual
        return view('cars.edit', compact('car'));
    }

    // Método para atualizar um carro no banco de dados
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

    // Método para excluir um carro
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
