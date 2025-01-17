@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuarios'])
 
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Nova Secretaria</h6>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-body p-3">
                            <div class="row">
                                <form action="{{url('/secretaria')}}"  method="POST"> 
                                    {{ csrf_field() }}
                                    <div class="card-body pt-4 p-3">
                                        <div class="form-group row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label" >Nome da Secretaria </label>
                                                <input type="text" id="nome_secretaria" name="nome_secretaria"  class="form-control" placeholder=" Ex: Subsecretaria de Tecnologia" minlength="4" maxlength="100" required >	
                                            </div>

                                          
                                       
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="ln_solid"> </div>
                                        <div class="footer text-center">  
                                            <button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
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
   