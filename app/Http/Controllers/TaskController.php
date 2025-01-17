<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function gerenciar_projeto(Request $request, $id)
    {
        $projeto = Projeto::with('user')->findOrFail($id); // Corrigido: carregar o relacionamento user
        $users = User::all();
        $tasks = Task::with('user')->where('projeto_id', $id)->get(); // Filtra as tasks pelo ID do projeto
        // dd($tasks);

        return view('pages.task.gerencia', compact('projeto', 'users', 'tasks'));
    }


    public function updateStatus(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->status_task = $request->new_status;
        $task->save();

        return response()->json(['success' => true]);
    }



    public function cadastrar_task(Request $request)
    {
        // Criação do novo task
        $task = new Task();

        $task->nome_task = ucwords($request->nome_task);
        $task->descricao_task = ucwords($request->descricao_task);
        $task->status_task = "TAREFAS";
        $task->user_responsavel = $request->user_responsavel;
        $task->prazo = Carbon::parse($task->created_at)->addDays($request->prazo);

        $task->projeto_id = $request->projeto_id;

        $task->save(); // Salva o task no banco

        return response()->json([
            'projeto_id' => $task->projeto_id,
            'nome_task' => ucwords($task->nome_task),
            'descricao_task' => ucwords($task->descricao_task),
            'user_responsavel' => $task->user->name, // Assumindo que há um relacionamento no modelo User
            'prazo' => $task->prazo,
            'id' => $task->id,
            'message' => 'Task cadastrada com sucesso!'
        ]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deletado com sucesso.');
    }
}
