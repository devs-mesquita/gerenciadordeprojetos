@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css"> 
@section('content')
    @include('layouts.navbars.auth.topnav')
    <div class="container-fluid px-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Alteração de Senha</h6>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                            
                                <form action="{{ url('postalterasenha') }}" method="POST" class="form-horizontal" id="form-altera-senha" autocomplete="false">
                                    {{ csrf_field() }}
                                    
                                    <div class="row">
                                    
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-md-offset-2 col-sm-3  col-sm-offset-2 col-xs-12" for="password_atual">
                                                Senha Atual
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="password" name="password_atual" class="form-control error" maxlength="16">
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-md-offset-2 col-sm-3  col-sm-offset-2 col-xs-12" for="password">
                                                Nova Senha
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="password" name="password" class="form-control error" maxlength="16">
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-md-offset-2 col-sm-3  col-sm-offset-2 col-xs-12" for="password_confirmation">
                                                Confirmação da Senha
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="password" name="password_confirmation" type="password" class="form-control error" maxlength="16">
                                            </div>
                                        </div>
                                    </div>  <!-- FIM ROW  -->
                                
                                    {{-- BOTÕES --}}
                                    <div class="ln_solid"> </div>
                                    <div class="footer text-center"> {{-- col-md-3 col-md-offset-9 --}}
                                        <button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
                                            <span class="icone-botoes-acao mdi mdi-send"></span>
                                            <span class="texto-botoes-acao"> SALVAR </span>
                                            <div class="ripple-container"></div>
                                        </button>	
                                    
                                        <button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" >
                                            <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                                            <span class="texto-botoes-acao"> CANCELAR </span>
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

@push('scripts')

	<script type="text/javascript">
		$(document).ready(function() {
			var tempo = 0;
			var incremento = 500;
			
			@if (session('sucesso'))
				swal('Parabéns!', '{{ session('sucesso') }}' ,'success');
			@endif
			
	      {{-- Testar se há algum erro, e mostrar a notificação --}}
			var tempo = 0;
			var incremento = 500;
	      @if ($errors->any())
	         @foreach ($errors->all() as $error)
	            setTimeout(function(){funcoes.notificationRight("top", "right", "danger", "{{ $error }}"); }, tempo);
	            tempo += incremento;
	         @endforeach
			@endif

		});

		//botão de cancelar
		$("#btn_cancelar").click(function(){
			event.preventDefault();
			window.location.href = "{{ URL::route('home') }}"; 
		});


	</script>


@endpush



