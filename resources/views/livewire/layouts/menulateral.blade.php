<div>
    <!-- Vertical Nav -->
    <nav class="hk-nav hk-nav-dark">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close">
            <span class="feather-icon"><i data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item" id="dash">
                        <a class="nav-link" href="#" id="button-dash" data-active="dash" data-activ="" data-section="dash">
                            <span class="feather-icon"><i data-feather="map"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item" id="bFile">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#fichier_drp">
                            <span class="feather-icon"><i data-feather="user"></i></span>
                            <span class="nav-link-text">Agent</span>
                        </a>
                        <ul id="fichier_drp" class="nav flex-column collapse collapse-level-1" >
                            <li class="nav-item" >
                                <ul class="nav flex-column">
                                    <li class="nav-item" id="aCatPrix">
                                        <a class="nav-link" href="#" id="button-aCatPrix" data-active="aCatPrix" wire:click="$emit('catPrixUpdated')" data-open="bFile" data-section="aCatPrix">Catalogue de prix</a>
                                    </li>
                                    <li class="nav-item" id="etBes">
                                        <a class="nav-link" href="#" id="button-etBes" data-active="etBes" wire:click="$emit('ebUpdated')" data-open="bFile" data-section="etBes">Etat de besoin</a>
                                    </li>
                                    <li class="nav-item" id="usMvmt">
                                        <a class="nav-link" href="#" id="button-usMvmt" data-active="usMvmt" wire:click="$emit('mvtUpdated')" data-open="bFile" data-section="usMvmt">Mouvement</a>
                                    </li>
                                    <li class="nav-item" id="usTrans">
                                        <a class="nav-link" href="#" id="button-usTrans" data-active="usTrans" wire:click="$emit('dtUpdated')" data-open="bFile" data-section="usTrans">Demande de transport</a>
                                    </li>
                                    <li class="nav-item" id="usConge">
                                        <a class="nav-link" href="#" id="button-usConge" data-active="usConge" wire:click="$emit('congeUpdated')" data-open="bFile" data-section="usConge">Conge</a>
                                    </li>
                                    <li class="nav-item" id="contr">
                                        <a class="nav-link" href="#" id="button-contr" data-active="contr" wire:click="$emit('contratUpdated')" data-open="bFile" data-section="contr">Contrat</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>

                    @if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bPimis">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pimis_drp">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Pimis</span>
                            </a>
                            <ul id="pimis_drp" class="nav flex-column collapse collapse-level-1" >
                                <li class="nav-item" >
                                    <ul class="nav flex-column">
                                        <li class="nav-item" id="pres">
                                            <a class="nav-link" href="#" id="button-pres" data-active="pres" wire:click="$emit('allUpdated')" data-open="bPimis" data-section="pres">Présentation</a>
                                        </li>
                                        <li class="nav-item" id="userB">
                                            <a class="nav-link" href="#" id="button-userB" data-active="userB" wire:click="$emit('usersUpdated')" data-open="bPimis" data-section="userB">Utilisateurs</a>
                                        </li>
                                        <li class="nav-item" id="serv">
                                            <a class="nav-link" href="#" id="button-serv" data-active="serv" wire:click="$emit('projectUpdated')" data-open="bPimis" data-section="serv">Projets</a>
                                        </li>
                                        <li class="nav-item" id="resp">
                                            <a class="nav-link" href="#" id="button-resp" data-active="resp" wire:click="$emit('bailleurUpdated')" data-open="bPimis" data-section="resp">Bailleurs</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'R.H' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bRH">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#RH_drp">
                                <span class="feather-icon"><i data-feather="users"></i></span>
                                <span class="nav-link-text">Resources humaines</span>
                            </a>

                            <ul id="RH_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item" id="art">
                                            <a class="nav-link" href="#" id="button-art" data-active="art" wire:click="$emit('agentUpdated')" data-open="bRH" data-section="art">Agents</a>
                                        </li>
                                        <li class="nav-item" id="aff">
                                            <a class="nav-link" href="#" id="button-aff" data-active="aff" wire:click="$emit('affectationUpdated')" data-open="bRH" data-section="aff">Affectations</a>
                                        </li>
                                        <li class="nav-item" id="mvmt">
                                            <a class="nav-link" href="#" id="button-mvmt" data-active="mvmt" wire:click="$emit('mouvementUpdated')" data-open="bRH" data-section="mvmt">Mouvements agents</a>
                                        </li>
                                        <li class="nav-item" id="miss">
                                            <a class="nav-link" href="#" id="button-miss" data-active="miss" wire:click="$emit('affectationUpdated')" data-open="bRH" data-section="miss">Missions</a>
                                        </li>
                                        <li class="nav-item" id="conge">
                                            <a class="nav-link" href="#" id="button-conge" data-active="conge" wire:click="$emit('congeUpdated')" data-open="bRH" data-section="conge">Conges</a>
                                        </li>
                                        <li class="nav-item" id="recrut">
                                            <a class="nav-link" href="#" id="button-recrut" data-active="recrut" wire:click="$emit('recrutementUpdated')" data-open="bRH" data-section="recrut">Recrutement</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'MAG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bStock">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#stock">
                                <span class="feather-icon"><i data-feather="package"></i></span>
                                <span class="nav-link-text">Stock & Logistique</span>
                            </a>
                            <ul id="stock" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        @if (Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                                            <li class="nav-item" id="bonReqS">
                                                <a class="nav-link" href="#" id="button-bonReqS" data-active="bonReqS" wire:click="$emit('bonReqUpdated')" data-open="bStock" data-section="bonReqS">Bons de réquisition</a>
                                            </li>
                                            <li class="nav-item" id="demAchS">
                                                <a class="nav-link" href="#" id="button-demAchS" data-active="demAchS" wire:click="$emit('demAchUpdated')" data-open="bStock" data-section="demAchS">Demandes d'achat</a>
                                            </li>
                                        @endif

                                        @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')

                                            <li class="nav-item" id="bonComS">
                                                <a class="nav-link" href="#" id="button-bonComS" data-active="bonComS" data-open="bStock" data-section="bonComS">Bons de commande</a>
                                            </li>
                                            <li class="nav-item" id="fournS">
                                                <a class="nav-link" href="#" id="button-fournS" data-active="fournS" wire:click="$emit('fournisseurUpdated')" data-open="bStock" data-section="fournS">Fournisseurs</a>
                                            </li>
                                            <li class="nav-item" id="contPrixS">
                                                <a class="nav-link" href="#" id="button-contPrixS" data-active="contPrixS" data-open="bStock" data-section="contPrixS">Contrat & Prix</a>
                                            </li>
                                        @endif

                                        @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'MAG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                                            <li class="nav-item" id="entreeS">
                                                <a class="nav-link" href="#" id="button-entreeS" data-active="entreeS" data-open="bStock" data-section="entreeS">Entrées</a>
                                            </li>
                                            <li class="nav-item" id="sortieS">
                                                <a class="nav-link" href="#" id="button-sortieS" data-active="sortieS" data-open="bStock" data-section="sortieS">Sorties</a>
                                            </li>
                                        @endif
                                        <li class="nav-item" id="invS">
                                            <a class="nav-link" href="#" id="button-invS" data-active="invS" data-open="bStock" data-section="invS">Inventaire</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'D.A.F' || Auth::user()->role == 'COMPT1' ||Auth::user()->role == 'COMPT2' || Auth::user()->role == 'CAISS' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bFinance">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#finance">
                                <span class="feather-icon"><i data-feather="pocket"></i></span>
                                <span class="nav-link-text">Finance</span>
                            </a>
                            <ul id="finance" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item" id="bonReqF">
                                            <a class="nav-link" href="#" id="button-bonReqF" data-active="bonReqF" wire:click="$emit('bonReqUpdated')" data-open="bFinance" data-section="bonReqF">Bons de réquisition</a>
                                        </li>
                                        <li class="nav-item" id="demAchF">
                                            <a class="nav-link" href="#" id="button-demAchF" data-active="demAchF" wire:click="$emit('demAchUpdated')" data-open="bFinance" data-section="demAchF">Demandes d'achat</a>
                                        </li>
                                        <li class="nav-item" id="bonpayF">
                                            <a class="nav-link" href="#" id="button-bonpayF" data-active="bonpayF" data-open="bFinance" data-section="bonpayF">Bons de payement</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'C.P' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bProjet">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#projet">
                                <span class="feather-icon"><i data-feather="activity"></i></span>
                                <span class="nav-link-text">Projet</span>
                            </a>
                            <ul id="projet" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item" id="bonReqP">
                                            <a class="nav-link" href="#" id="button-bonReqP" data-active="bonReqP" wire:click="$emit('bonReqUpdated')" data-open="bProjet" data-section="bonReqP">Bons de réquisition</a>
                                        </li>
                                        <li class="nav-item" id="demAchP">
                                            <a class="nav-link" href="#" id="button-demAchP" data-active="demAchP" wire:click="$emit('demAchUpdated')" data-open="bProjet" data-section="demAchP">Demandes d'achat</a>
                                        </li>
                                        <li class="nav-item" id="bonpayF">
                                            <a class="nav-link" href="#" id="button-bonpayP" data-active="bonpayP" data-open="bProjet" data-section="bonpayP">Demandes de congé</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <hr class="nav-separator">
                <div class="nav-header">
                    <span>tech</span>
                </div>
                <ul class="navbar-nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="feather-icon"><i data-feather="headphones"></i></span>
                            <span class="nav-link-text">Support</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


    </nav>
    <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>


    <!-- /Vertical Nav -->


    <div class="hk-settings-panel">
        <div class="nicescroll-bar position-relative">
            <div class="settings-panel-wrap">
                <div class="settings-panel-head">
                    <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span
                            class="feather-icon"><i data-feather="x"></i></span></a>
                </div>
                <hr>
                <h6 class="mb-5">Navigation</h6>
                <p class="font-14">Menu comes in two modes: dark & light</p>
                <div class="button-list hk-nav-select mb-10">
                    <button type="button" id="nav_light_select"
                        class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                    <button type="button" id="nav_dark_select"
                        class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                </div>
                <hr>
                <h6 class="mb-5">Top Nav</h6>
                <p class="font-14">Choose your liked color mode</p>
                <div class="button-list hk-navbar-select mb-10">
                    <button type="button" id="navtop_light_select"
                        class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                    <button type="button" id="navtop_dark_select"
                        class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Scrollable Header</h6>
                    <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
                </div>
                <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reset</button>
            </div>
        </div>
    </div>
</div>
