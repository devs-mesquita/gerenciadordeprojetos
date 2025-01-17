<div class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" style="text-align: center;" href="{{ route('home') }}">
            <img src="{{ asset('img/brasao.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Gerenciador de Projetos</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav px-2">

      
            <li>
                <button class="nav-link btn active w-100 text-start" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTarefasGerais" aria-expanded="false" aria-controls="collapseTarefasGerais">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-primary text-lg opacity-10"></i>
                    </div>
                    Gerência de Projetos
                </button>
                <div class="collapse dropdown-menu-no-shadow" id="collapseTarefasGerais">
                    <div class="card-body border-0">
                        <ul>
                            <li>
                                <a class="nav-link btn collapse dropdown-menu-no-shadow  active w-100 text-start"
                                    href="{{ route('tarefas_gerais.index') }}" aria-expanded="false">
                                    Projetos Gerais
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </li>
            {{-- <li>
                <button class="nav-link btn active w-100 text-start" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chart-pie-35 text-primary text-lg opacity-10"></i>
                    </div>
                    Dashboards
                </button>
                <div class="collapse dropdown-menu-no-shadow" id="collapseDashboards">
                    <div class="card-body border-0">
                        <ul>
                            <li>
                                <a class="nav-link btn collapse dropdown-menu-no-shadow  active w-100 text-start"
                                    href="#" aria-expanded="false">
                                    EM BREVE... 
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </li> --}}
            <li>
                <button class="nav-link btn active w-100 text-start" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseConfiguracao" aria-expanded="false" aria-controls="collapseConfiguracao">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings-gear-65 text-primary text-lg opacity-10"></i>
                    </div>
                Configurações
                </button>
                <div class="collapse dropdown-menu-no-shadow" id="collapseConfiguracao">
                    <div class="card-body border-0">
                        <ul>
                            <li>
                                <a class="nav-link btn collapse dropdown-menu-no-shadow  active w-100 text-start"
                                    href="{{ route('secretaria.index') }}" aria-expanded="false">
                                   Secretaria 
                                </a>
                            </li>
                            <li>
                                <a class="nav-link btn collapse dropdown-menu-no-shadow  active w-100 text-start"
                                    href="{{ route('setor.index') }}" aria-expanded="false">
                                   Setores 
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </li>
            @if (Auth::user()->nivel == 'ADMIN')
                <li>
                    <button class="nav-link btn active w-100 text-start" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseUsuarios" aria-expanded="false" aria-controls="collapseUsuarios">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-circle-08 text-primary text-lg opacity-10"></i>
                        </div>
                        Usuários
                    </button>
                    <div class="collapse dropdown-menu-no-shadow" id="collapseUsuarios">
                        <div class="card-body border-0">
                            <ul>
                                <li>
                                    <a class="nav-link btn collapse dropdown-menu-no-shadow  active w-100 text-start"
                                        href="{{ route('user.index') }}" aria-expanded="false">
                                        Lista de Usuários
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>

    <br><br><br><br><br><br><br><br>
    <div>
        <a type="button" class="sidebar-footer hidden-small" data-bs-toggle="modal" data-bs-target="#atualizaModal"
            style="text-align: center; font-size: 15px; color: #bfa15f; padding-bottom: 15px;">
            Notas de Atualização
        </a>
    </div>
    <div class="modal fade" id="atualizaModal" tabindex="-1" role="dialog" aria-labelledby="atualizaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="atualizaModalLabel">Notas de Atualização</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Versão Beta 1.0</h3>
                    <p>Esta versão contém as funcionalidades básicas do sistema; que ainda está em atualização.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"></script>
    
@endpush
