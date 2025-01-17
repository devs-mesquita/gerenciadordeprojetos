@extends('layouts.app')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">

@section('content')
    @include('layouts.navbars.auth.topnav')
    <div id="app">
        @include('flash-message')
        @yield('content')
    </div>
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Novo Usuario</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('user.store') }}" class="flex flex-col gap-4" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="w-full mx-auto">
                                        <div class="flex justify-center mb-4">
                                            <img id="selectedAvatar" src="{{ asset('img/placeholder-avatar.jpg') }}"
                                                class="rounded-full object-cover"
                                                style="width: 200px; height: 200px;" alt="example placeholder" />
                                        </div>
                                        <div class="flex justify-center">
                                            <div class="relative cursor-pointer bg-blue-500 text-white rounded-full px-4 py-2">
                                                <label class="cursor-pointer" for="customFile2">Escolher Foto</label>
                                                <input type="file" class="hidden" name="foto" id="customFile2"
                                                    onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                        <div class="form-group row">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="control-label">Nome</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Nome" minlength="4" maxlength="100" required>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="control-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    placeholder="Email" minlength="4" maxlength="100" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="control-label">Telefone</label>
                                                <input type="telefone" id="telefone" name="telefone" class="form-control"
                                                    placeholder="Telefone" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label class="control-label">CPF</label>
                                                <input type="text" id="cpf" name="cpf" class="form-control"
                                                    placeholder="CPF" minlength="4" maxlength="15" required>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label">Nível</label>
                                                <select class="form-control" name="nivel" id="nivel" required>
                                                    @if (Auth::user()->nivel == 'ADMIN')
                                                        <option value="" selected>Selecione o nível do usuário</option>
                                                        <option value="ADMIN">ADMIN</option>
                                                        <option value="USUARIO">USUARIO</option> 
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label">Setor</label>
                                                <select class="form-control" name="setor_id" id="setor_id" required>
                                                    <option value="" selected>Selecione o setor</option>
                                                    @foreach($setores as $setor)

                                                        <option value="{{ $setor->id }}">{{ $setor->nome_setor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>

                                  
                                    <div class="footer text-center">
                                        <button type="submit" id="btn_salvar"
                                            class="botoes-acao btn btn-round btn-success">
                                            <span class="icone-botoes-acao mdi mdi-send"></span>
                                            <span class="texto-botoes-acao"> SALVAR </span>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        // Máscara de telefone
        VMasker(document.querySelector("#telefone")).maskPattern("(99) 99999-9999");
        VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");
    </script>

    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endpush
