<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
    // Buscar todos os carros no banco de dados
    $cars = Car::all(); // Use o modelo correspondente, ajustando o nome, se necessário.

    // Retornar a view com os carros
    return view('cars.index', compact('cars'));
    }


    //mostrar carros publico
    public function publicIndex()
    {
        // Buscar todos os carros no banco de dados
        $cars = Car::all(); // Ajuste se necessário para filtrar apenas os carros disponíveis.

        // Retornar a view pública com os carros
        return view('cars.public', compact('cars'));
    }


    public function create()
    {
        // Exibe a view para criar um novo carro
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // Log para verificar se o método foi chamado
        \Log::info('Método store chamado.');

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
            \Log::info('Imagem recebida: ' . $imagePath);  // Log do caminho da imagem
        } else {
            \Log::info('Nenhuma imagem enviada.');
        }

        // Dados que serão criados
        \Log::info('Dados do carro:', [
            'name' => $request->name,
            'brand' => $request->brand,
            'year' => $request->year,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        // Cria o carro com os dados, incluindo o caminho da imagem
        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'year' => $request->year,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        // Log para garantir que a criação foi concluída
        \Log::info('Carro criado com sucesso!');

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
