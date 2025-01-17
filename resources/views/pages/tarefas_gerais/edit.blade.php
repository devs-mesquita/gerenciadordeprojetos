@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Tarefa'])

    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Editar Tarefa</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('tarefas_gerais.update', $tarefas_gerais->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome_projeto" class="form-control-label">Nome do Projeto</label>
                            <input class="form-control" type="text" name="nome_projeto" id="nome_projeto"
                                value="{{ old('nome_projeto', $tarefas_gerais->nome_projeto) }}"
                                placeholder="Nome do Projeto" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lider_projeto_id" class="form-control-label">Responsável do Projeto</label>
                            <select id="lider_projeto_id" name="lider_projeto_id" class="form-control" required>
                                <option value="">Selecione o Responsável do Projeto</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $tarefas_gerais->lider_projeto_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="setor_id" class="form-control-label">Setor Operante:</label>
                        <select class="form-control" id="setor_id" name="setor_id" required autocomplete="off">
                            
                            {{-- <option value="">Selecione o Setor</option> --}}
                            <option value="{{$user->setor->id}}">{{$user->setor->nome_setor}}</option>
                            @foreach ($setores as $setor)
                                <option value="{{ $setor->id }}">{{ $setor->nome_setor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao_projeto" class="form-control-label">Descrição do Projeto</label>
                            <textarea class="form-control" name="descricao_projeto" id="descricao_projeto" rows="4">{{ old('descricao_projeto', $tarefas_gerais->descricao_projeto) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Data Início</label>
                            <input type="date" id="data_inicio" name="data_inicio" class="form-control"
                                value="{{ old('data_inicio', $tarefas_gerais->data_inicio ? $tarefas_gerais->data_inicio->format('Y-m-d') : '') }}"
                                required>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Data Final</label>
                            <input type="date" id="data_final" name="data_final" class="form-control"
                                value="{{ old('data_final', $tarefas_gerais->data_final ? $tarefas_gerais->data_final->format('Y-m-d') : '') }}"
                                required>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="EM ANDAMENTO"
                                    {{ $tarefas_gerais->status == 'EM ANDAMENTO' ? 'selected' : '' }}>EM ANDAMENTO</option>
                                <option value="CONCLUIDO" {{ $tarefas_gerais->status == 'CONCLUIDO' ? 'selected' : '' }}>
                                    CONCLUIDO</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ route('tarefas_gerais.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Add additional JavaScript logic for edit form
        });
    </script>
@endpush
