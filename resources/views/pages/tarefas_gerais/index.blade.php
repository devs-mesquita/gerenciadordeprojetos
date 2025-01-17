@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<style>
    .bg-custom-danger {
        background-color: #f32f2f !important;
    }

    .text-black {
        color: #020000;
    }

    .grid-tarefas {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        grid-auto-rows: 1fr;
        gap: 24px;
    }

    @media (min-width: 650px) {
        .grid-tarefas {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 1280px) {
        .grid-tarefas {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    .card-inteiro {
        display: flex;
        flex-direction: column;
    }

    .topo-do-card {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 18px;
        border-radius: 14px;
    }

    .topo-vermelho {
        background-color: #d61f07;
    }

    .topo-verde {
        background-color: #126624;
    }

    .topo-laranja {
        background-color: #FF6100;
    }

    .topo-neutro {
        background-color: #bbb1b1;
    }

    .body-do-card {
        padding: 14px;
        display: flex;
        flex-direction: column;
    }

    .imagem-responsiva {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tarefas Gerais'])
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                
                <h6>Tarefas Gerais</h6>

                <div class="col-6 text-end">
                    <a  class="btn bg-gradient-dark dropdown-toggle" style="margin-bottom: 0"
                        data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                        Setores Tecnologia
                    </a>
                    
                    <ul class="dropdown-menu" id="dropdownSetores" aria-labelledby="navbarDropdownMenuLink2">
                        <li><a class="dropdown-item"  href="{{asset('/')}}">Todos</a></li>
                        
                        @foreach ($setores as $setor)
                            <li><a class="dropdown-item" href="{{asset('/filtro/'.$setor->id)}}"> {{$setor->nome_setor}} </a></li>
                        @endforeach

                        {{-- 
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                    </ul>

                    <a class="btn bg-gradient-dark mb-0" href="{{ url('tarefas_gerais/create') }}">Cadastrar novo Projeto</a>
                </div>
            </div>

            <div class="grid-tarefas">
                @foreach ($tarefas_gerais as $tarefa)
                    @php
                        $hoje = now();
                        $dataFinal = $tarefa->data_final;
                        $diasRestantes = $hoje->diffInDays($dataFinal, false);

                        if ($tarefa->status === 'CONCLUIDO') {
                            $classeTopo = 'topo-verde';
                            $classeProgressBar = 'bg-success';
                        } elseif ($diasRestantes <= 0) {
                            $classeTopo = 'topo-vermelho';
                            $classeProgressBar = 'bg-danger';
                        } elseif ($diasRestantes <= 15) {
                            $classeTopo = 'topo-vermelho';
                            $classeProgressBar = 'bg-danger';
                        } elseif ($diasRestantes <= 30) {
                            $classeTopo = 'topo-laranja';
                            $classeProgressBar = 'bg-warning';
                        } else {
                            $classeTopo = 'topo-neutro';
                            $classeProgressBar = 'bg-secondary';
                        }
                    @endphp

                    <div class="card shadow-lg border-2 card-inteiro" style="cursor: pointer;"
                        onclick="window.location='{{ route('tarefas_gerais.edit', $tarefa->id) }}'">
                        <div class="topo-do-card {{ $classeTopo }}">
                            <img src="{{ asset('uploads/' . $tarefa->user->foto) }}"
                                class="fixed rounded-circle mb-3 border border-secondary imagem-responsiva"
                                alt="Foto do líder">
                        </div>

                        <div class="body-do-card">
                            <h5 class="card-title fw-bold mb-2 text-black">{{ $tarefa->nome_projeto }}</h5>
                            <p class="mb-1 small text-black"><strong>Líder do Projeto:</strong> {{ $tarefa->user->name }}</p>
                            <p class="mb-1 small text-black"><strong>Setor Destinado:</strong> {{ $tarefa->user->setor->nome_setor }}</p>
                            <p class="mb-2 text-black small"><strong>Descrição:</strong> {{ $tarefa->descricao_projeto }}</p>
                            <p class="mb-0 text-black small"><strong>Status:</strong>
                                <span class="badge rounded-pill {{ $classeTopo }}">{{ $tarefa->status }}</span>
                            </p>
                            <p class="mb-1 text-black small">
                                <strong>Prazo Restante:</strong>
                                <span class="badge rounded-pill {{ $classeTopo }}">
                                    @if ($diasRestantes > 0)
                                        {{ $diasRestantes }} dia{{ $diasRestantes > 1 ? 's' : '' }} restante{{ $diasRestantes > 1 ? 's' : '' }}
                                    @elseif ($diasRestantes === 0)
                                        Hoje é o prazo final
                                    @else
                                        Expirado há {{ abs($diasRestantes) }} dia{{ abs($diasRestantes) > 1 ? 's' : '' }}
                                    @endif
                                </span>
                            </p>

                            {{-- MALDITA BARRA DE PROGRESSO 
                            <div class="progress my-2">
                                <div 
                                    class="progress-bar {{ $classeProgressBar }}" 
                                    role="progressbar"
                                    style="width: {{ $tarefa->progresso }}%;" 
                                    aria-valuenow="{{ $tarefa->progresso }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100"
                                >
                                    {{ $tarefa->progresso }}%
                                </div>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection

@push('js')
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/api/setores-relacionados', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            const dropdown = document.getElementById('dropdownSetores');
            dropdown.innerHTML = ''; // Limpa qualquer conteúdo existente

            data.forEach(setor => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `
                    <a class="dropdown-item" href="#" id="setor-${setor.id}">
                        ${setor.nome}
                    </a>
                `;
                dropdown.appendChild(listItem);
            });
        })
        .catch(error => console.error('Erro ao carregar os setores:', error));
    });
</script> --}}
@endpush
