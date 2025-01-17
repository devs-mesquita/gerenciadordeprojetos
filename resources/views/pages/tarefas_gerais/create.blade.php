@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cadastrar Projeto'])
    {{--     
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8 mx-auto"> --}}
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Cadastrar Nova Tarefa</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('tarefas_gerais.store') }}" method="POST">
                @csrf
        
                <div class="row">
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome_projeto" class="form-control-label">Nome do Projeto</label>
                            <input class="form-control" type="text" name="nome_projeto" id="nome_projeto"
                                placeholder="Nome do Projeto" required>
                        </div>
                    </div>
        
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lider_projeto_id" class="form-control-label">Responsável do Projeto</label>
                            <select id="lider_projeto_id" name="lider_projeto_id" class="form-control" required>
                                <option value="">Selecione o Responsável do Projeto</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                <div class="col-md-4 ">
                    <div class="form-group">
                    <label class="control-label">Setor Destinado:</label>
                    <select class="form-select" name="setor_id" id="setor_id" required>
                        <option value="" selected>Selecione o setor</option>
                        @foreach($setores as $setor)
                            <option value="{{ $setor->id }}">{{ $setor->nome_setor }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao_projeto" class="form-control-label">Descrição do Projeto</label>
                            <textarea class="form-control" name="descricao_projeto" id="descricao_projeto" rows="4"></textarea>
                        </div>
                    </div>
                </div>

           
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Data Início</label>
                            <input type="date" id="data_inicio" name="data_inicio" class="form-control"
                                placeholder="Data Início do Projeto" required>
                        </div>
                    </div>
        
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Data Final</label>
                            <input type="date" id="data_final" name="data_final" class="form-control"
                                placeholder="Data Final do Projeto" required>
                        </div>
                    </div>
        
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                                <option value="CONCLUIDO">CONCLUIDO</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>

    @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script>
        // Optional: Add any client-side validation or form interactions here
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Prevent form submission with empty required fields
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const titulo = document.getElementById('titulo');

                if (!titulo.value.trim()) {
                    event.preventDefault();
                    titulo.classList.add('is-invalid');
                    // Optional: Show error message
                }
            });
        });
    </script>
@endpush
