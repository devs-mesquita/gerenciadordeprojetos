@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuarios'])
    <div class="card">
        <div class="card-body">
            <table id="scc" class="display">
                <div>

                    <ul class="nav navbar-right panel_toolbox">
                        <h6>Lista de Usuários</h6>
                        <a href="{{ url('user/create') }}" class="btn btn-primary btn-md  ms-auto" data-toggle="tooltip"
                            data-placement="bottom" title="" data-original-title="Nova Sala">Cadastrar Usuario
                        </a>


                        <thead>

                            <tr>
                                <th>Nome do Usuário </th>
                                <th>E-mail do Usuário</th>
                                <th>Setor</th>
                                <th>Nível</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td> {{$user->setor->nome_setor}}</td>
                                <td>{{ $user->nivel }}</td>
                                <td class="text-center">

                                    <div style="display:flex; gap: 8px; align-items: center;">
                                        <a id="btn_show" style="margin: 0;"
                                            href="{{ route('user.edit', ['user' => $user->id]) }}" title="Editar">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a id="btn_exclui_user" style="margin: 4;" href="#"
                                            data-excluir="{{ $user->id }}" title="Excluir">
                                            <i class="fa fa-trash"></i>
                                        </a>
                        @endforeach
                </div>
                </tr>
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
    <script>
        var table = new DataTable('#scc', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
            },
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("table#scc").on("click", "#btn_exclui_user", function() {
            let id = $(this).data('excluir');
            // console.log(id);
            let btn = $(this);
            Swal.fire({
                title: 'Você tem certeza que deseja excluir o usuário?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua isso!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(id);
                    $.post("{{ url('/user') }}/" + id, {
                        id: id,
                        _method: "DELETE",
                        _token: "{{ csrf_token() }}"
                    }).done(function() {
                        location.reload();
                    });
                }
            })
        });
    </script>
@endpush
