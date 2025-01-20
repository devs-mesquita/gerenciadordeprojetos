@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<style>   
    .imagem-responsiva {
        width: 220px;
        /* Define a largura fixa */
        height: 220px;
        /* Define a altura fixa */
        object-fit: cover;
        /* Mantém a proporção ao cortar excessos */
        border-radius: 50%;
        /* Torna a imagem circular */
    }
</style>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuários'])

    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Editar Usuário</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('user.update', $user->id) }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PUT')

                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center mb-4">
                                    <img src="{{ asset('filestorages/' . $user->foto) }}" class="rounded-circle border border-secondary imagem-responsiva"
                                        alt="Foto do usuário" width="200" height="200">
                                    {{-- <img src="{{ asset('uploads/' . $user->foto) }}" class="rounded-circle border border-secondary imagem-responsiva"
                                        alt="Foto do usuário" width="200" height="200"> --}}
                                         {{-- <img src="{{ asset('uploads/' . $user->foto) }}" class="rounded-circle" alt="Foto do usuário"> --}}
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Nome" value="{{ $user->name }}" minlength="4" maxlength="100" required>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Email" value="{{ $user->email }}" minlength="4" maxlength="100" required>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" id="cpf" name="cpf" class="form-control"
                                        placeholder="CPF" value="{{ $user->cpf }}" minlength="4" maxlength="15" required>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control"
                                        value="{{ $user->telefone }}" placeholder="Telefone" required>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="nivel" class="form-label">Permissão</label>
                                    <select class="form-control" name="nivel" id="nivel" required>
                                        <option value="ADMIN" {{ old('nivel', $user->nivel) == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                                        <option value="USUARIO" {{ old('nivel', $user->nivel) == 'USUARIO' ? 'selected' : '' }}>USUARIO</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="setor_id" class="form-control-label">Setor Operante:</label>
                                    <select class="form-control" id="setor_id" name="setor_id" required autocomplete="off">
                                        
                                        {{-- <option value="">Selecione o Setor</option> --}}
                                        <option value="{{$user->setor->id}}">{{$user->setor->nome_setor}}</option>
                                        @foreach ($setor as $setores)
                                            <option value="{{ $setores->id }}">{{ $setores->nome_setor }}</option>
                                        @endforeach
                                    </select>
                                </div> 

                            </div>

                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>

                            <div class="footer text-center">
                                <button type="submit" class="btn btn-success btn-round">
                                    <span class="mdi mdi-send"></span> SALVAR
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
@endsection

@push('js')
    <script src="{{ asset('/assets/js/vanillaMasker.min.js') }}"></script>
    <script>
        VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");
        VMasker(document.querySelector("#telefone")).maskPattern("(99) 99999-9999");
    </script>
@endpush
