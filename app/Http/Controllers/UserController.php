<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setor;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $usuario = User::all();
        $setor = Setor::with('secretaria')->get();
        $users = User::with('setor')->get(); 
        $setores = Setor::all();
        return view('pages.user.index', compact('users','setores'));
    }

    public function create()
    {

        $setores = Setor::all();

        return view('pages.user.create', compact('setores'));
    }

    public function store(Request $request)
    {

        $existingUser = User::where('cpf', $request->cpf)->orWhere('email',$request->email)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'O CPF informado já está cadastrado no sistema!');
        }
      

        try {
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->cpf = $request->cpf;
            $user->telefone = $request->telefone;
            $user->nivel = $request->nivel;
            $user->setor_id = $request->setor_id; 
    
            if ($request->hasFile('foto')) {

                $fotoPath = $request->foto->store('gerenciaprojetos' ,'arquivos');
                // $fotoPath = $request->foto->store('foto', 'local');
                $user->foto = $fotoPath;
            }
    
            $user->save();
            return redirect()->route('user.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar o usuário: ' . $e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $setor = Setor::all();
        return view('pages.user.edit', compact('user','setor'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
            $user->telefone = $request->telefone;
            $user->nivel = $request->nivel;
            $user->setor_id = $request->setor_id;

            // Handle photo upload
            if ($request->hasFile('foto')) {
                // $fotoPath = $request->file('foto')->store('foto', 'public');
                $fotoPath = $request->foto->store('gerenciaprojetos' ,'arquivos');
                $user->foto = $fotoPath;
            }

            $user->save();
            return redirect()->route('user.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o usuário: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
            return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao deletar o usuário: ' . $e->getMessage()], 500);
        }
    }

    public function AlteraSenha()
    {
        $usuario = Auth::user();
        return view('pages.user.alterasenha', compact('usuario'));
    }

    public function SalvarSenha(Request $request)
    {
        $usuario = User::find(Auth::user()->id);

        if (Hash::check($request->password_atual, $usuario->password)) {
            $usuario->update(['password' => Hash::make($request->password)]);
            return redirect('/home')->with('success', 'Senha alterada com sucesso.');
        } else {
            return back()->withErrors(['password_atual' => 'Senha atual não confere.']);
        }
    }
}
