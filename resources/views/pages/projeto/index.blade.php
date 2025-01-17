@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<head>
    <style>
        .bolha {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 100%;
            height: auto;
            border: 2px solid black;
            border-radius: 20px;
            /* Rounded border */
            padding: 10px;
        }

        .bolha:hover {
            color: black;
            cursor: pointer;
        }

        .icon {
            flex: 0 0 auto;
            /* Keeps the icon from stretching */
            margin-right: 10px;
        }

        .icon i {
            font-size: 30px;
            color: #fff;
            /* Adjust the icon color */
        }

        .btn_div {
            flex: 1;
            /* Makes the text container expand to fill remaining space */
            background-color: transparent;
            padding: 5px 15px;
            border: 2px solid rgb(168, 168, 168);
            border-radius: 15px;
            white-space: nowrap;
            /* Keep the text on one line */
            overflow: hidden;
            /* Hide overflow text */
            text-overflow: ellipsis;
            /* Add ellipsis (...) for long text */
            color: #000000;
            /* Adjust text color */
            font-size: 16px;
        }

        .d-flex {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            /* Align cards starting from the right */
        }

        .projeto-card {
            width: 18%;
            margin: 1%;
        }

        @media (max-width: 768px) {
            .projeto-card {
                width: 45%;
                /* Adjust width for smaller screens */
            }
        }

        @media (max-width: 576px) {
            .projeto-card {
                width: 90%;
                /* Stack cards for very small screens */
            }
        }
    </style>
</head>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuarios'])

    <div class="card">
        <div class="card-body">

            <div>
                <h6 style="text-align: center">Projetos em Campo</h6>
                @if (Auth::user()->nivel == 'ADMIN')
                    <ul class="nav navbar-right panel_toolbox">
                        <button type="button" class="btn btn-primary btn-md ms-auto" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Cadastrar Projeto</button>
                    </ul>
                @endif
            </div>

            <div class="d-flex flex-wrap justify-content-right" id="listaProjetos">
                @foreach ($projetos as $projeto)
                    <div class="projeto-card"
                        onclick="card_projeto('{{ $projeto->nome_projeto }}',
                        '{{ $projeto->descricao_projeto }}', '{{ $projeto->setor }}',
                        '{{ $projeto->id }}')">

                        <div class="row justify-content-center p-2 m-3 bolha">
                            <div class="col-md-12 d-flex align-items-center">
                                <span class="me-2"><i class="fa fa-clock"></i></span>
                                <a class="btn_div" onclick="botao_projeto(event)"
                                    href="{{ route('gerenciar_projeto', $projeto->id) }}">
                                    <span>{{ $projeto->nome_projeto }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- Modal criar projeto --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Projeto</h1>
                </div>
                <div class="modal-body">
                    <form id="projetoForm">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="nome_projeto" class="col-form-label">Nome do Projeto:</label>
                            <input type="text" class="form-control" id="nome_projeto" name="nome_projeto" required
                                minlength="10" maxlength="40">
                        </div>
                        <div class="mb-3">
                            <label for="descricao_projeto" class="col-form-label">Descrição do Projeto:</label>
                            <input type="text" class="form-control" id="descricao_projeto" name="descricao_projeto"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="setor" class="col-form-label">Setor do Projeto:</label>
                            <select class="form-control" name="setor" required>
                                <option value="">Selecione o setor</option>
                                <option value="SAUDE">SAUDE</option>
                                <option value="PREFEITURA">PREFEITURA</option>
                                <option value="EDUCACAO">EDUCACAO</option>
                            </select>
                        </div>
                    </form>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="cadastrarProjeto">Cadastrar
                        Projeto</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Função para redirecionar para a página de gerenciamento do projeto
        function botao_projeto(event, projetoId) {
            // Previne que o clique acione outros eventos (como abrir o modal)
            event.stopPropagation();

        }


        // Função para criar e exibir o modal com detalhes do projeto
        function card_projeto(nomeProjeto, descricaoProjeto, setorProjeto, idProjeto) {
            // Remover o modal anterior, se houver
            $('#projetomodal').remove();

            // Gerar o HTML do modal dinamicamente
            const modalHtml = `
                <div class="modal fade" id="projetomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes do Projeto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="detalhe_nome_projeto" class="col-form-label">Nome do Projeto:</label>
                                    <input type="text" class="form-control" id="detalhe_nome_projeto" value="${nomeProjeto ? nomeProjeto : 'Sem nome'}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="detalhe_descricao_projeto" class="col-form-label">Descrição do Projeto:</label>
                                    <input type="text" class="form-control" id="detalhe_descricao_projeto" value="${descricaoProjeto ? descricaoProjeto : 'Sem descrição'}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="detalhe_setor_projeto" class="col-form-label">Setor do Projeto:</label>
                                    <input type="text" class="form-control" id="detalhe_setor_projeto" value="${setorProjeto ? setorProjeto : 'Sem setor'}" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- Formulário para deletar projeto -->
                                <form id="deletarProjetoForm" method="POST" action="/projeto/${idProjeto}" onsubmit="confirmarDeletar(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: red; color: white">
                                        Deletar Projeto
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Adiciona o modal ao corpo do documento
            $('body').append(modalHtml);

            // Exibe o modal
            $('#projetomodal').modal('show');
        }




        $(document).ready(function() {
            $('#cadastrarProjeto').on('click', function() {
                var nomeProjeto = $('#nome_projeto').val();
                var descricaoProjeto = $('#descricao_projeto').val();
                var setor = $('select[name="setor"]').val();

                if (nomeProjeto.length < 6) {
                    alert("Nome do Projeto muito pequeno");
                    return;
                }

                if (nomeProjeto === "" || descricaoProjeto === "" || setor === "") {
                    alert("Por favor, preencha todos os campos.");
                    return;
                }

                $.ajax({
                    url: '{{ route('cadastrar_projeto') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        nome_projeto: nomeProjeto,
                        descricao_projeto: descricaoProjeto,
                        setor: setor,
                    },
                    success: function(response) {
                        console.log(response);
                        // Fecha o modal e reseta o formulário
                        $('#exampleModal').modal('hide');
                        $('#projetoForm')[0].reset();

                        // Usa os dados retornados na resposta para preencher o novo projeto
                        $('#listaProjetos').append(`

                            <div class="projeto-card"
                                onclick="card_projeto('${response.nome_projeto}',
                                '${response.descricao_projeto}',
                                '${response.setor}', '${response.id}')">

                                <div class="row justify-content-center p-2 m-3 bolha">
                                    <div class="col-md-12 d-flex align-items-center">
                                        <span class="me-2"><i class="fa fa-clock"></i></span>
                                        <a class="btn_div" onclick="botao_projeto(event)"
                                            href="/gerenciar_projeto/${response.id}">
                                            <span class="col-md-3">${response.nome_projeto}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `);
                    },
                    error: function(req, err) {
                        alert('Ocorreu um erro ao cadastrar o projeto.');
                        console.log(err);
                    }
                });
            });

            // Preenche os detalhes do projeto no modal ao clicar
            $('#projetomodal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botão que disparou o modal
                var nomeProjeto = button.data('nome');
                var descricaoProjeto = button.data('descricao');
                var setorProjeto = button.data('setor');
                var idProjeto = button.data('id');
                $('#detalhe_nome_projeto').val(nomeProjeto);
                $('#detalhe_descricao_projeto').val(descricaoProjeto);
                $('#detalhe_setor_projeto').val(setorProjeto);
                // Atualiza o formulário de exclusão com o ID correto
                $('#deletarProjetoForm').attr('action', '/projeto/' + idProjeto);
            });
        });
    </script>


    {{-- excluir --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmarDeletar(event) {
            event.preventDefault(); // Impede o envio do formulário imediato

            Swal.fire({
                title: "Você tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, delete!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deletado!",
                        text: "O usuário foi deletado.",
                        icon: "success"
                    });
                    event.target.submit();
                }
            });
        }
    </script>
@endpush


