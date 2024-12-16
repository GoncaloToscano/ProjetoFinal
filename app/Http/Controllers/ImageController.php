<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function destroy(Image $image)
    {
        // Verifica se a imagem existe
        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Imagem não encontrada.'], 404);
        }
    
        // Remove a imagem do sistema de arquivos (armazenamento público)
        Storage::disk('public')->delete($image->path);
    
        // Exclui a imagem do banco de dados
        $image->delete();
    
        // Retorna uma resposta JSON de sucesso
        return response()->json(['success' => true]);
    }
    

    
}
