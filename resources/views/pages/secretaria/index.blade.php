@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuarios'])
  <div class="card">
       <div class="card-body">
<table id="scc" class="display">
    <div>
    
        <ul class="nav navbar-right panel_toolbox">
            
        <a href="{{url('secretaria/create')}}" class="btn btn-primary btn-md  ms-auto" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala">Cadastrar secretaria </a> 
   
        <thead>
       
            <tr>
                <th>Nome do secretaria </th>
                <th>Ações </th>
                
            </tr>
            </thead>

            @foreach ($secretarias as $secretaria)
              <tr>
              <td>{{$secretaria->nome_secretaria}}</td>         
              <td class="text-center">
                
                        <a id="btn_exclui_secretaria" style="margin: 4;"
                        href="#"
                        data-excluir='{{$secretaria->id}}'
                        title="Excluir">
                        <i class="fa fa-trash" ></i> 
                    </a>
            </td>     
           
            </tr>

        @endforeach
      </ul>
    </div>

</table>
    
</div>
  </div>
    
    
</table>
  
    @include('layouts.footers.auth.footer')
    @endsection
            
    @push('js')
      
      <script src="//code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>   
      <script>var table = new DataTable('#scc', {
      language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
      },  
  }); </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
$("table#scc").on("click", "#btn_exclui_secretaria" ,function(){
let id = $(this).data('excluir');
     // console.log(id);
     let btn = $(this);
        Swal.fire({
                    title: 'Você tem certeza que deseja excluir o secretaria?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, exclua isso!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(id);
                        $.post("{{ url('/secretaria')}}/" + id, {
                            id: id,
                            _method: "DELETE",
                            _token:"{{csrf_token()}}"
                            }).done(function() {
                                location.reload();
                            });
                    }
                 })             
});
</script> 
     

 

@endpush