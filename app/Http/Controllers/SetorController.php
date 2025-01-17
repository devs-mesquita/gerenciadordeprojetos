<?php

namespace App\Http\Controllers;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Models\Secretaria;

class SetorController extends Controller
{
    public function index()
    {

   $setores = Setor::with('secretaria')->get();
   $secretarias = Secretaria::all();
        return view('pages.setor.index', compact('setores','secretarias'));
    }


    public function create()
    {
        $secretarias = Secretaria::all();
        $setor = Setor::all();
        return view('pages.setor.create',compact('secretarias'));
    }
    
    public function store(Request $request)
{
    // dd($request->all());
    $setor = new Setor;
    $setor->nome_setor =  $request->nome_setor;
    $setor->secretaria_id = $request->secretaria_id;

    $setor->save();

    return redirect()->route('setor.index')->with('success', 'Setor criado com sucesso!');
}
 
public function destroy($id)
{
    $setor  = Setor::findOrFail($id);
    $setor->delete(); 

    // return redirect()->route('pages.user.index');
}
}