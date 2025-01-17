<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projetos = Projeto::all();
        return view('pages.projeto.index', compact('projetos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Projeto $projeto)
    {
        //
    }

    public function edit(Projeto $projeto)
    {
        //
    }

    public function update(Request $request, Projeto $projeto)
    {
        //
    }

    public function destroy($id)
    {
        $projeto = Projeto::findOrFail($id);
        $projeto->delete();

        return redirect()->back()->with('success', 'Projeto deletado com sucesso.');
    }

    public function cadastrar_projeto(Request $request)
    {
        // Criação do novo projeto
        $projeto = new Projeto();
        $projeto->nome_projeto = ucwords($request->nome_projeto); // Use snake_case
        $projeto->descricao_projeto = ucwords($request->descricao_projeto);
        $projeto->setor = ucwords($request->setor);
        $projeto->repositorio = null;
        $projeto->save(); // Salva o projeto no banco

        return response()->json([
            'nome_projeto' => ucwords($projeto->nome_projeto),
            'descricao_projeto' => ucwords($projeto->descricao_projeto),
            'setor' => ucwords($projeto->setor),
            'id' => $projeto->id,
            'message' => 'Projeto cadastrado com sucesso!'
        ]);
    }

    public function mostrar_projeto($id, Request $request)
    {

        $projeto = Projeto::findorfail($id);


        return response()->json([
            'nome_projeto' => ucwords($projeto->nome_projeto),
            'descricao_projeto' => ucwords($projeto->descricao_projeto),
            'setor_projeto' => ucwords($projeto->setor),
            'message' => 'Projeto cadastrado com sucesso!'
        ]);
    }

}
