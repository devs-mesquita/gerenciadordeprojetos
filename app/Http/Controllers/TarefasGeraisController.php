<?php

namespace App\Http\Controllers;

use App\Models\TarefasGerais;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Http\Request;

class TarefasGeraisController extends Controller
{
    public function index($setor=null)
    {
        $setores = Setor::all();

        // dd($setor);

        $tarefas_gerais = TarefasGerais::with('user')
        ->when($setor !== null, function ($query) use ($setor) {
            return $query->where('setor_id', $setor);
        })
        ->get();

        // $tarefas_gerais = TarefasGerais::with('user')
        //     ->orderByRaw('
        //         CASE 
        //             WHEN status = "CONCLUIDO" THEN 1
        //             ELSE 0
        //         END ASC,
        //         DATEDIFF(data_final, NOW()) ASC
        //     ')
        //     ->get();

        // Adiciona progresso dinamicamente
        foreach ($tarefas_gerais as $tarefa) {
            $hoje = now();
            $dataInicio = $tarefa->data_inicio;
            $dataFinal = $tarefa->data_final;

            if ($dataInicio && $dataFinal) {
                if ($dataFinal > $hoje) {
                    $diasTotais = $dataInicio->diffInDays($dataFinal);
                    $diasPassados = $dataInicio->diffInDays($hoje);

                    $tarefa->progresso = $diasTotais > 0 ? round(($diasPassados / $diasTotais) * 100) : 0;
                } else {
                    $tarefa->progresso = 100;
                }
            } else {
                $tarefa->progresso = 0;
            }
        }

        return view('pages.tarefas_gerais.index', compact( 'tarefas_gerais','setores'));
    }

    public function create()
    {
        $setores = Setor::all();
        $users = User::all();

        return view('pages.tarefas_gerais.create', compact('users', 'setores'));
    }

    public function store(Request $request)
    {
        $tarefas_gerais = new TarefasGerais;
        $tarefas_gerais->nome_projeto = $request->nome_projeto;
        $tarefas_gerais->descricao_projeto = $request->descricao_projeto;
        $tarefas_gerais->data_inicio = $request->data_inicio;
        $tarefas_gerais->data_final = $request->data_final;
        $tarefas_gerais->status = $request->status;
        $tarefas_gerais->lider_projeto_id = $request->lider_projeto_id;
        $tarefas_gerais->setor_id = $request->setor_id;

        $tarefas_gerais->save();

        return redirect()->route('tarefas_gerais.index')->with('success', 'Projeto cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $tarefas_gerais = TarefasGerais::findOrFail($id);
        $users = User::all();
        $setores = Setor::all();

        return view('pages.tarefas_gerais.edit', compact('tarefas_gerais', 'users', 'setores'));
    }

    public function update(Request $request, $id)
    {
        $tarefas_gerais = TarefasGerais::findOrFail($id);

        $tarefas_gerais->nome_projeto = $request->nome_projeto;
        $tarefas_gerais->descricao_projeto = $request->descricao_projeto;
        $tarefas_gerais->data_inicio = $request->data_inicio;
        $tarefas_gerais->data_final = $request->data_final;
        $tarefas_gerais->lider_projeto_id = $request->lider_projeto_id;
        $tarefas_gerais->status = $request->status;
        $tarefas_gerais->setor_id = $request->setor_id;

        $tarefas_gerais->save();

        return redirect()->route('tarefas_gerais.index')->with('success', 'Edição concluída!');
    }

    public function getSetoresRelacionados(Request $request)
    {
        $userId = auth()->id(); // Obtém o ID do usuário autenticado

        $setores = Setor::where('user_id', $userId)->get(['id', 'nome_setor']); // Retorna apenas os campos necessários

        return response()->json($setores);
    }
}
