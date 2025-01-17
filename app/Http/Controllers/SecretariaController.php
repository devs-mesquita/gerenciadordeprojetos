<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secretaria;
use App\Models\Setor;

class SecretariaController extends Controller
{
 
    public function index()
    {
        $secretarias = Secretaria::all(); 

        return view('pages.secretaria.index', compact('secretarias'));
    }

  
    public function create()
    {
        return view('pages.secretaria.create');
    }

  
    public function store(Request $request)
    {
          
        Secretaria::create([
            'nome_secretaria' => $request->input('nome_secretaria'),
        ]);

        return redirect()->route('secretaria.index')
                         ->with('success', 'Secretaria criada com sucesso!');
    }

  
    public function edit($id)
    {
        $secretaria = Secretaria::findOrFail($id); 

        return view('pages.secretaria.edit', compact('secretaria'));
    }

  
    public function update(Request $request, $id)
    {
   
       
        $secretaria = Secretaria::findOrFail($id);
        $secretaria->update([
            'nome' => $request->input('nome'),
        ]);

        return redirect()->route('secretaria.index')
                         ->with('success', 'Secretaria atualizada com sucesso!');
    }


    public function destroy($id)
    {
        $secretaria = Secretaria::findOrFail($id);
        $secretaria->delete();

        return redirect()->route('secretaria.index')
                         ->with('success', 'Secretaria excluída com sucesso!');
    }
}