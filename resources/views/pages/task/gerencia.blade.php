@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<head>
    {{-- <style>
        .column {
            display: flex;
            flex-direction: column;
            width: 300px;
            padding: 10px;
            border: 2px solid black;
            border-radius: 10px;
            margin: 5px;
            color: black;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .task {
            padding: 10px;
            margin: 10px 0;
            border: 2px solid rgb(255, 0, 179);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            height: 100px;
            max-height: 100%;
        }

        .task:hover {
            background-color: #b6b6b6;
        }

        .board {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            height: 100%;
            max-height: 100%;
            border: rgb(4, 0, 255) 3px solid;
        }

        .card-body{
            height: 100%;
            max-height: 100%;
            border: red 3px solid;
        }


    </style> --}}

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            box-sizing: border-box;
        }

        .column {
            display: flex;
            flex-direction: column;
            width: 300px;
            padding: 10px;
            border: 2px solid black;
            border-radius: 10px;
            margin: 5px;
            color: black;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            height: 100%;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .task {
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            border: rgb(168, 168, 168) 3px solid;
            text-align: center;
            cursor: pointer;
            height: 100px;
            max-height: 100%;
        }

        .task:hover {
            background-color: #b6b6b6;
        }

        .board {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            height: calc(100vh - 148px);
            /* Altura total da tela menos margem da borda */
            max-height: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Usuarios'])

    <div class="card">
        <div class="card-body">
            <div class="board">
                <div class="column drop_zone" data-status="TAREFAS">
                    <div>
                        Tarefas
                        @if (Auth::user()->nivel == 'ADMIN')
                            <button style="text-align: end" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        @endif
                    </div>
                    {{-- Aqui virá a lista de tasks --}}
                    <div id="listaTasks">

                        @foreach ($tasks as $task)
                            @if ($task->status_task == 'TAREFAS' && Auth::user()->id == $task->user->id)
                                <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                    class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                    data-user-id="{{ $task->user->id }}">
                                    {{ $task->nome_task }}
                                    <br>
                                    {{ $task->user->name }}
                                </div>
                            @endif
                        @endforeach

                        @foreach ($tasks as $task)
                            @if ($task->status_task == 'TAREFAS' && Auth::user()->id != $task->user->id)
                                <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                    class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                    data-user-id="{{ $task->user->id }}">
                                    {{ $task->nome_task }}
                                    <br>
                                    {{ $task->user->name }}
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="column drop_zone" data-status="FAZENDO">
                    <div>Fazendo</div>
                    @foreach ($tasks as $task)
                        @if ($task->status_task == 'FAZENDO' && Auth::user()->id == $task->user->id)
                            <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                data-user-id="{{ $task->user->id }}">
                                {{ $task->nome_task }}
                                <br>
                                {{ $task->user->name }}
                            </div>
                        @endif
                    @endforeach

                    @foreach ($tasks as $task)
                        @if ($task->status_task == 'FAZENDO' && Auth::user()->id != $task->user->id)
                            <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                data-user-id="{{ $task->user->id }}">
                                {{ $task->nome_task }}
                                <br>
                                {{ $task->user->name }}
                            </div>
                        @endif
                    @endforeach

                </div>

                <div class="column drop_zone" data-status="ANALISE">
                    <div>Em Análise</div>
                    @foreach ($tasks as $task)
                        @if ($task->status_task == 'ANALISE' && Auth::user()->id == $task->user->id)
                            <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                data-user-id="{{ $task->user->id }}">
                                {{ $task->nome_task }}
                                <br>
                                {{ $task->user->name }}
                            </div>
                        @endif
                    @endforeach

                    @foreach ($tasks as $task)
                        @if ($task->status_task == 'ANALISE' && Auth::user()->id != $task->user->id)
                            <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                data-user-id="{{ $task->user->id }}">
                                {{ $task->nome_task }}
                                <br>
                                {{ $task->user->name }}
                            </div>
                        @endif
                    @endforeach


                </div>

                <div class="column drop_zone" data-status="FINALIZADO">
                    <div>Finalizado</div>
                    @foreach ($tasks as $task)
                        @if ($task->status_task == 'FINALIZADO' && Auth::user()->id == $task->user->id)
                            <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                data-user-id="{{ $task->user->id }}">
                                {{ $task->nome_task }}
                                <br>
                                {{ $task->user->name }}
                            </div>
                        @endif
                    @endforeach

                    @foreach ($tasks as $task)
                        @if ($task->status_task == 'FINALIZADO' && Auth::user()->id != $task->user->id)
                            <div onclick="card_task('{{ $task->nome_task }}', '{{ $task->descricao_task }}','{{ $task->prazo }}', '{{ $task->user->name }}', '{{ $task->id }}')"
                                class="task draggble" draggable="true" data-id="{{ $task->id }}"
                                data-user-id="{{ $task->user->id }}">
                                {{ $task->nome_task }}
                                <br>
                                {{ $task->user->name }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Modal criar task --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Task</h1>
                </div>
                <div class="modal-body">
                    <form id="taskForm">
                        {{ csrf_field() }}

                        <input type="text" name="projeto_id" id="projeto_id" value="{{ $projeto->id }}" readonly
                            hidden>

                        <div class="mb-3">
                            <label for="nome_task" class="col-form-label">Nome da Task:</label>
                            <input type="text" class="form-control" id="nome_task" name="nome_task" required
                                minlength="10" maxlength="40">
                        </div>
                        <div class="mb-3">
                            <label for="descricao_task" class="col-form-label">Descrição da Task:</label>
                            <input type="text" class="form-control" id="descricao_task" name="descricao_task" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_responsavel" class="col-form-label">Responsável da Task:</label>
                            <select class="form-control" name="user_responsavel" required>
                                <option value="">Selecione o responsável</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prazo" class="col-form-label">Prazo da Task (em dias):</label>
                            <input type="number" class="form-control" id="prazo" name="prazo" min="1"
                                value="1" required>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="cadastrarTask">Cadastrar Task</button>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('layouts.footers.auth.footer') --}}
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- cadastar task --}}
    <script>
        $('#cadastrarTask').on('click', function() {
            var nomeTask = $('#nome_task').val();
            var descricaoTask = $('#descricao_task').val();
            var prazo = $('#prazo').val();
            var responsavel = $('select[name="user_responsavel"]').val();
            var projetoId = $('#projeto_id').val();

            if (nomeTask === "" || descricaoTask === "" || responsavel === "" || projetoId === "") {
                alert("Por favor, preencha todos os campos.");
                return;
            }

            $.ajax({
                url: '{{ route('cadastrar_task') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    projeto_id: projetoId,
                    nome_task: nomeTask,
                    descricao_task: descricaoTask,
                    user_responsavel: responsavel,
                    prazo: prazo,
                },
                success: function(response) {

                    $('#exampleModal').modal('hide');
                    $('#taskForm')[0].reset();

                    $('#listaTasks').append(`
                        <div onclick="card_task('${response.nome_task}', '${response.descricao_task }','${response.prazo }', '${response.user_responsavel }', '${response.id }')"
                            class="task draggble" draggable="true" data-id="${response.id }">
                                ${response.nome_task }
                            <br>
                            ${response.user_responsavel }
                        </div>
                    `);

                    const newElement = document.querySelector(`div[data-id="${response.id}"]`);
                    newElement.addEventListener('dragstart', dragStart);
                    newElement.addEventListener('dragend', dragEnd);
                },
                error: function(xhr, status, error) {
                    alert('Ocorreu um erro ao cadastrar a task.');
                }
            });
        });
    </script>

    {{-- modal task --}}
    <script>
        // Função para criar e exibir o modal com detalhes do projeto
        function card_task(nomeTask, descricaoTask, prazoTask, responsavel_task, idTask) {
            // Remover o modal anterior, se houver
            $('#projetomodal').remove();

            function formatDate(dateTimeString) {
                // Cria um objeto Date a partir da string ISO
                const date = new Date(dateTimeString);

                // Extrai o dia, mês e ano
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Mês começa em 0, por isso soma-se 1
                const year = date.getFullYear();

                // Retorna no formato dd/mm/yyyy
                return `${day}/${month}/${year}`;
            }

            prazoTask = formatDate(prazoTask)

            console.log('Nome do Projeto:', nomeTask);
            console.log('Descrição do Projeto:', descricaoTask);
            console.log('Setor do Projeto:', prazoTask);
            console.log('responsavel do Projeto:', responsavel_task);
            console.log('ID do Projeto:', responsavel_task);


            // Gerar o HTML do modal dinamicamente
            const modalHtml = `
                <div class="modal fade" id="projetomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes da Task</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="detalhe_nome_task" class="col-form-label">Nome da Task:</label>
                                    <input type="text" class="form-control" id="detalhe_nome_task" value="${nomeTask ? nomeTask : 'Sem nome'}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="detalhe_descricao_task" class="col-form-label">Descrição da Task:</label>
                                    <input type="text" class="form-control" id="detalhe_descricao_task" value="${descricaoTask ? descricaoTask : 'Sem descrição'}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="detalhe_prazo_task" class="col-form-label">Prazo da Task:</label>
                                    <input type="text" class="form-control" id="detalhe_prazo_task" value="${prazoTask ? prazoTask : 'Sem prazo'}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="detalhe_responsavel_task" class="col-form-label">Responsável pela Task:</label>
                                    <input type="text" class="form-control" id="detalhe_responsavel_task" value="${responsavel_task ? responsavel_task : 'Sem responsável'}" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- Formulário para deletar task -->
                                <form id="deletarTaskForm" method="POST" action="/task/${idTask}" onsubmit="confirmarDeletar(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: red; color: white">
                                        Deletar Task
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
    </script>

    {{-- drag n drop //att status --}}
    {{-- <script>
        let draggedItem = null;

        // Seleciona todas as tarefas e zonas de soltura
        const draggables = document.querySelectorAll('.draggble');
        const dropZones = document.querySelectorAll('.drop_zone');

        // Adiciona os eventos de arrastar e soltar
        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', dragStart);
            draggable.addEventListener('dragend', dragEnd);
        });

        dropZones.forEach(zone => {
            zone.addEventListener('dragover', dragOver);
            zone.addEventListener('dragenter', dragEnter);
            zone.addEventListener('dragleave', dragLeave);
            zone.addEventListener('drop', dragDrop);
        });

        // Função chamada quando o arrastar começa
        function dragStart(event) {
            draggedItem = this;
            setTimeout(() => {
                this.style.display = 'none';
            }, 0);
        }

        // Função chamada quando o arrastar termina
        function dragEnd(event) {
            setTimeout(() => {
                this.style.display = 'block';
                draggedItem = null;
            }, 0);
        }

        // Permite que o item seja solto
        function dragOver(event) {
            event.preventDefault();
        }

        // Adiciona uma classe ao entrar na zona de soltura
        function dragEnter(event) {
            event.preventDefault();
            this.classList.add('over');
        }

        // Remove a classe quando o item sai da zona de soltura
        function dragLeave() {
            this.classList.remove('over');
        }

        // Função chamada quando o item é soltado
        function dragDrop() {
            this.classList.remove('over');
            if (draggedItem) {
                this.appendChild(draggedItem);
                // Atualiza o status da tarefa
                updateTaskStatus(draggedItem, this);
            }
        }

        // Atualiza o status da tarefa
        function updateTaskStatus(taskElement, dropZone) {
            const newStatus = dropZone.dataset.status;
            const taskId = taskElement.dataset.id; // Obtém o ID da tarefa

            $.ajax({
                url: '{{ route('task.updateStatus') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    task_id: taskId, // Passa o ID da tarefa
                    new_status: newStatus,
                },
                success: function(response) {
                    if (!response.success) {
                        alert('Erro ao atualizar status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocorreu um erro ao atualizar o status da tarefa.');
                }
            });
        }
    </script> --}}

    <script>
        const isAdmin = {{ Auth::user()->nivel === 'ADMIN' ? 'true' : 'false' }};
        const loggedInUserId = {{ Auth::user()->id }};
    </script>

    <script>
        let draggedItem = null;

        // Seleciona todas as tarefas e zonas de soltura
        const draggables = document.querySelectorAll('.draggble');
        const dropZones = document.querySelectorAll('.drop_zone');

        // Adiciona os eventos de arrastar e soltar
        draggables.forEach(draggable => {
            const taskOwnerId = parseInt(draggable.dataset.userId);

            // Permitir arrastar apenas se o usuário é o dono da tarefa ou é um admin
            if (isAdmin || taskOwnerId === loggedInUserId) {
                draggable.addEventListener('dragstart', dragStart);
                draggable.addEventListener('dragend', dragEnd);
            }
        });

        dropZones.forEach(zone => {
            zone.addEventListener('dragover', dragOver);
            zone.addEventListener('dragenter', dragEnter);
            zone.addEventListener('dragleave', dragLeave);
            zone.addEventListener('drop', dragDrop);
        });

        function dragStart(event) {
            draggedItem = this;
            setTimeout(() => {
                this.style.display = 'none';
            }, 0);
        }

        function dragEnd(event) {
            setTimeout(() => {
                this.style.display = 'block';
                draggedItem = null;
            }, 0);
        }

        function dragOver(event) {
            event.preventDefault();
        }

        function dragEnter(event) {
            event.preventDefault();
            this.classList.add('over');
        }

        function dragLeave() {
            this.classList.remove('over');
        }

        function dragDrop() {
            this.classList.remove('over');
            if (draggedItem) {
                this.appendChild(draggedItem);
                updateTaskStatus(draggedItem, this);
            }
        }

        function updateTaskStatus(taskElement, dropZone) {
            const newStatus = dropZone.dataset.status;
            const taskId = taskElement.dataset.id;

            $.ajax({
                url: '{{ route('task.updateStatus') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    task_id: taskId,
                    new_status: newStatus,
                },
                success: function(response) {
                    if (!response.success) {
                        alert('Erro ao atualizar status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocorreu um erro ao atualizar o status da tarefa.');
                }
            });
        }
    </script>
@endpush
