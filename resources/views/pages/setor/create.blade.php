@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuários'])

    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Novo Setor</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3">
                            <div class="row">
                                <form action="{{ url('/setor') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label class="control-label">Nome do Setor</label>
                                            <input type="text" id="nome_setor" name="nome_setor" class="form-control"
                                                placeholder="Ex: Subsecretaria de Tecnologia" minlength="4"
                                                maxlength="100" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="secretaria_id" class="form-control-label">Secretaria</label>
                                            <select class="form-control" name="secretaria_id" id="secretaria_id" required>
                                                <option value="">Selecione uma Secretaria</option>
                                                @foreach ($secretarias as $secretaria)
                                                    <option value="{{ $secretaria->id }}">{{ $secretaria->nome_secretaria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="ln_solid"></div>
                                    <div class="footer text-center">
                                        <button type="submit" id="btn_salvar"
                                            class="btn btn-round btn-success">
                                            <span class="mdi mdi-send"></span>
                                            SALVAR
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
        document.querySelectorAll("#cpf, #telefone").forEach(function(input) {
            if (input.id === "cpf") {
                VMasker(input).maskPattern("999.999.999-99");
            } else if (input.id === "telefone") {
                VMasker(input).maskPattern("(99) 99999-9999");
            }
        });
    </script>
@endpush