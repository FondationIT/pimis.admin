<div>
    <!-- Vertical Nav -->
    <nav class="hk-nav hk-nav-dark">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close">
            <span class="feather-icon"><i data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <div class="nav-header">
                    <h4><span style="color: #F5BF60">
                    @if (Auth::user()->role == 'Sup')SUPER USER @endif
                    @if (Auth::user()->role == 'ADMIN')ADMIN @endif
                    @if (Auth::user()->role == 'S.E')EXECUTIVE @endif
                    @if (Auth::user()->role == 'D.A.F')ADMINISTRATION ET FINANCE @endif
                    @if (Auth::user()->role == 'D.P')PROGRAMME @endif
                    @if (Auth::user()->role == 'C.P')PROJET @endif
                    @if (Auth::user()->role == 'R.H')RESOURCES HUMAINES @endif
                    @if (Auth::user()->role == 'A.I')AUDIT INTERNE @endif
                    @if (Auth::user()->role == 'COMPT1')COMTABILITE NIV 1 @endif
                    @if (Auth::user()->role == 'COMPT2')COMPTABILITE NIV 2 @endif
                    @if (Auth::user()->role == 'CAISS')CAISSSE @endif
                    @if (Auth::user()->role == 'LOG1')LOGISTIQUE DIRECTION @endif
                    @if (Auth::user()->role == 'LOG2')LOGISTIQUE OPERATION @endif
                    @if (Auth::user()->role == 'MAG')MAGASIN @endif
                    @if (Auth::user()->role == 'SECU')SECURITE @endif
                </span></h4>
            </div>
            <hr class="nav-separator">



                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="button-dash" data-active="dash" data-activ="" data-section="dash">
                           Tableau de bord
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
                                        <a class="nav-link" href="#" id="button-aCatPrix" data-active="aCatPrix" wire:click="$emit('articleUpdated')" data-open="bFile" data-section="aCatPrix">Catalogue de prix</a>
                                    </li>

                                    <li class="nav-item" id="catProd">
                                        <a class="nav-link" href="#" id="button-catProd" data-active="catProd" wire:click="$emit('categorieUpdated','productssUpdated')" data-open="bFile" data-section="catProd">Categorie & Ptoduit</a>
                                    </li>

                                    <li class="nav-item" id="fichSt">
                                        <a class="nav-link" href="#" id="button-fichSt" data-active="fichSt" wire:click="$emit('fichStUpdated')" data-open="bFile" data-section="fichSt">Fiche de stock</a>
                                    </li>

                                    <li class="nav-item" id="etBes">
                                        <a class="nav-link" href="#" id="button-etBes" data-active="etBes" wire:click="$emit('ebUpdated')" data-open="bFile" data-section="etBes">Etat de besoin</a>
                                    </li>

                                    <li class="nav-item" id="tdr">
                                        <a class="nav-link" href="#" id="button-tdr" data-active="tdr" wire:click="$emit('tdrUpdated')" data-open="bFile" data-section="tdr">Terme de reference</a>
                                    </li>

                                    <li class="nav-item" id="di">
                                        <a class="nav-link" href="#" id="button-di" data-active="di" wire:click="$emit('diUpdated')" data-open="bFile" data-section="di">Demmande interne</a>
                                    </li>

   
                                    <li class="nav-item" id="usMvmt">
                                        <a class="nav-link" href="#" id="button-usMvmt" data-active="usMvmt" wire:click="$emit('mvtUpdated')" data-open="bFile" data-section="usMvmt">Mouvement</a>
                                    </li>
                                    <li class="nav-item" id="usTrans">
                                        <a class="nav-link" href="#" id="button-usTrans" data-active="usTrans" wire:click="$emit('dtUpdated')" data-open="bFile" data-section="usTrans">Demande de transport</a>
                                    </li>
                                    <li class="nav-item" id="conge">
                                        <a class="nav-link" href="#" id="button-conge" data-active="conge" wire:click="$emit('congeUpdated')" data-open="bFile" data-section="conge">Conge</a>
                                    </li>
                                    <li class="nav-item" id="contr">
                                        <a class="nav-link" href="#" id="button-contr" data-active="contr" wire:click="$emit('contratUpdated')" data-open="bFile" data-section="contr">Contrat</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>

                    @if (App\Models\Agent::firstWhere('id', Auth::user()->agent)->fonction == 1)
                        <li class="nav-item" id="bService">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#service">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Service</span>
                            </a>
                            <ul id="service" class="nav flex-column collapse collapse-level-1" >
                                <li class="nav-item" >
                                    <ul class="nav flex-column">
                                        <li class="nav-item" id="artS">
                                            <a class="nav-link" href="#" id="button-artS" data-active="artS" wire:click="$emit('agentUpdated')" data-open="bService" data-section="artS">Agents</a>
                                        </li>
                                        <li class="nav-item" id="affS">
                                            <a class="nav-link" href="#" id="button-affS" data-active="affS" wire:click="$emit('affectationUpdated')" data-open="bService" data-section="affS">Affectations</a>
                                        </li>
                                        <li class="nav-item" id="mvmtS">
                                            <a class="nav-link" href="#" id="button-mvmtS" data-active="mvmtS" wire:click="$emit('mouvementUpdated')" data-open="bService" data-section="mvmtS">Mouvements agents</a>
                                        </li>
                                        <li class="nav-item" id="missS">
                                            <a class="nav-link" href="#" id="button-missS" data-active="missS" wire:click="$emit('affectationUpdated')" data-open="bService" data-section="missS">Missions</a>
                                        </li>
                                        <li class="nav-item" id="congeS">
                                            <a class="nav-link" href="#" id="button-congeS" data-active="congeS" wire:click="$emit('congeUpdated')" data-open="bService" data-section="congeS">Conges</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

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
                                        <li class="nav-item" id="contratA">
                                            <a class="nav-link" href="#" id="button-contratA" data-active="contratA" wire:click="$emit('contratUpdated')" data-open="bRH" data-section="contratA">Contrats Agents</a>
                                        </li>
                                        <li class="nav-item" id="aff">
                                            <a class="nav-link" href="#" id="button-aff" data-active="aff" wire:click="$emit('affectationUpdated')" data-open="bRH" data-section="aff">Affectations</a>
                                        </li>
                                        <li class="nav-item" id="compteA">
                                            <a class="nav-link" href="#" id="button-compteA" data-active="compteA" wire:click="$emit('compteUpdated')" data-open="bRH" data-section="compteA">Comptes Agents</a>
                                        </li>
                                        <li class="nav-item" id="paieA">
                                            <a class="nav-link" href="#" id="button-paieA" data-active="paieA" wire:click="$emit('paieAUpdated')" data-open="bRH" data-section="paieA">Paiemment Agents</a>
                                        </li>
                                        <li class="nav-item" id="mvmtR">
                                            <a class="nav-link" href="#" id="button-mvmtR" data-active="mvmtR" wire:click="$emit('mouvementUpdated')" data-open="bRH" data-section="mvmtR">Mouvements agents</a>
                                        </li>
                                        <li class="nav-item" id="tdr">
                                            <a class="nav-link" href="#" id="button-tdr" data-active="tdr" wire:click="$emit('tdrUpdated')" data-open="bRH" data-section="tdr">Termes de reference</a>
                                        </li>
                                        <li class="nav-item" id="missR">
                                            <a class="nav-link" href="#" id="button-missR" data-active="missR" wire:click="$emit('affectationUpdated')" data-open="bRH" data-section="missR">Missions</a>
                                        </li>
                                        <li class="nav-item" id="congeR">
                                            <a class="nav-link" href="#" id="button-congeR" data-active="congeR" wire:click="$emit('congeUpdated')" data-open="bRH" data-section="congeR">Conges</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'S.E' || Auth::user()->role == 'D.A.F' || Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'MAG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
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

                                        @if (Auth::user()->role == 'S.E' || Auth::user()->role == 'D.A.F' || Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')

                                            <li class="nav-item" id="pvS">
                                                <a class="nav-link" href="#" id="button-pvS" data-active="pvS" data-open="bStock" wire:click="$emit('pvUpdated')" data-section="pvS">PV d'analyse</a>
                                            </li>
                                            <li class="nav-item" id="bonComS">
                                                <a class="nav-link" href="#" id="button-bonComS" data-active="bonComS" data-open="bStock" wire:click="$emit('bcUpdated')" data-section="bonComS">Bons de commande</a>
                                            </li>
                                            <li class="nav-item" id="fournS">
                                                <a class="nav-link" href="#" id="button-fournS" data-active="fournS" wire:click="$emit('fournisseurUpdated')" data-open="bStock" data-section="fournS">Fournisseurs</a>
                                            </li>
                                            <li class="nav-item" id="compteS">
                                                <a class="nav-link" href="#" id="button-compteS" data-active="compteS" wire:click="$emit('compteUpdated')" data-open="bStock" data-section="compteS">Compte Fournisseur</a>
                                            </li>
                                            <li class="nav-item" id="prixMarcS">
                                                <a class="nav-link" href="#" id="button-prixMarcS" data-active="prixMarcS" data-open="bStock" wire:click="$emit('prixUpdated')" data-section="prixMarcS">Prix du marche</a>
                                            </li>
                                            <li class="nav-item" id="contPrixS">
                                                <a class="nav-link" href="#" id="button-contPrixS" data-active="contPrixS" data-open="bStock" wire:click="$emit('fprixUpdated')" data-section="contPrixS">Contrat & Prix</a>
                                            </li>
                                        @endif

                                        @if (Auth::user()->role == 'MAG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')

                                            @if (Auth::user()->role == 'MAG')

                                                <li class="nav-item" id="bonComS">
                                                    <a class="nav-link" href="#" id="button-bonComS" data-active="bonComS" data-open="bStock" wire:click="$emit('bcUpdated')" data-section="bonComS">Bons de commande</a>

                                                </li>
                                            @endif
                                            <li class="nav-item" id="entreeS">
                                                <a class="nav-link" href="#" id="button-entreeS" data-active="entreeS" data-open="bStock" wire:click="$emit('brUpdated')" data-section="entreeS">Bons de reception</a>
                                            </li>
                                            <li class="nav-item" id="diS">
                                                <a class="nav-link" href="#" id="button-diS" data-active="diS" wire:click="$emit('diUpdated')" data-open="bStock" data-section="diS">Demmande interne</a>
                                            </li>
                                        @endif
                                        <li class="nav-item" id="invS">
                                            <a class="nav-link" href="#" id="button-invS" data-active="invS" data-open="bStock" wire:click="$emit('invUpdated')" data-section="invS">Inventaire</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'S.E' || Auth::user()->role == 'D.A.F' || Auth::user()->role == 'COMPT1' ||Auth::user()->role == 'COMPT2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bFinance">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#finance">
                                <span class="feather-icon"><i data-feather="pocket"></i></span>
                                <span class="nav-link-text">Finance</span>
                            </a>
                            <ul id="finance" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item" id="compteF">
                                            <a class="nav-link" href="#" id="button-compteF" data-active="compteF" wire:click="$emit('compteUpdated')" data-open="bFinance" data-section="compteF">Compte Projet</a>
                                        </li>
                                        <li class="nav-item" id="bonReqF">
                                            <a class="nav-link" href="#" id="button-bonReqF" data-active="bonReqF" wire:click="$emit('bonReqUpdated')" data-open="bFinance" data-section="bonReqF">Bons de réquisition</a>
                                        </li>
                                        <li class="nav-item" id="bonReqF">
                                            <a class="nav-link" href="#" id="button-bonReqF" data-active="bonReqF" wire:click="$emit('bonReqUpdated')" data-open="bFinance" data-section="bonReqF">Bons de réquisition</a>
                                        </li>
                                        <li class="nav-item" id="tdr">
                                            <a class="nav-link" href="#" id="button-tdr" data-active="tdr" wire:click="$emit('tdrUpdated')" data-open="bFinance" data-section="tdr">Terme de reference</a>
                                        </li>
                                        <li class="nav-item" id="demAchF">
                                            <a class="nav-link" href="#" id="button-demAchF" data-active="demAchF" wire:click="$emit('demAchUpdated')" data-open="bFinance" data-section="demAchF">Demandes d'achat</a>
                                        </li>
                                        @if (Auth::user()->role == 'COMPT1' ||Auth::user()->role == 'COMPT2' || Auth::user()->role == 'CAISS')
                                        <li class="nav-item" id="bonComF">
                                            <a class="nav-link" href="#" id="button-bonComF" data-active="bonComF" wire:click="$emit('demAchUpdated')" data-open="bFinance" data-section="bonComF">Bons de commande</a>
                                        </li>
                                            @if (Auth::user()->role == 'COMPT1')
                                            <li class="nav-item" id="paieF">
                                                <a class="nav-link" href="#" id="button-paieF" data-active="paieF" wire:click="$emit('paieAUpdated')" data-open="bFinance" data-section="paieF">Paiemment Agents</a>
                                            </li>
                                            @endif
                                        @endif

                                        <li class="nav-item" id="notdebF">
                                            <a class="nav-link" href="#" id="button-notdebF" data-active="notdebF" data-open="bFinance" wire:click="$emit('ndUpdated')" data-section="notdebF">Notes de debit</a>
                                        </li>
                                        
                                        <li class="nav-item" id="bonpayF">
                                            <a class="nav-link" href="#" id="button-bonpayF" data-active="bonpayF" data-open="bFinance" wire:click="$emit('bpUpdated')" data-section="bonpayF">Bons de payement</a>
                                        </li>

                                        <li class="nav-item" id="opF">
                                            <a class="nav-link" href="#" id="button-opF" data-active="opF" data-open="bFinance" wire:click="$emit('opUpdated')" data-section="opF">Ordres de paiement</a>
                                        </li>

                                        <li class="nav-item" id="chequeF">
                                            <a class="nav-link" href="#" id="button-chequeF" data-active="chequeF" data-open="bFinance" wire:click="$emit('chequeUpdated')" data-section="chequeF">Cheques</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif



                    @if (Auth::user()->role == 'S.E' || Auth::user()->role == 'D.A.F' || Auth::user()->role == 'COMPT1' ||Auth::user()->role == 'COMPT2' || Auth::user()->role == 'CAISS' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <li class="nav-item" id="bFinance">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#caisse">
                                <span class="feather-icon"><i data-feather="book"></i></span>
                                <span class="nav-link-text">Caisse</span>
                            </a>
                            <ul id="caisse" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        @if (Auth::user()->role == 'CAISS')
                                        <li class="nav-item" id="bonpayC">
                                            <a class="nav-link" href="#" id="button-bonpayC" data-active="bonpayC" data-open="bCaisse" wire:click="$emit('bpUpdated')" data-section="bonpayC">Bons de payement</a>
                                        </li>
                                        <li class="nav-item" id="chequeC">
                                            <a class="nav-link" href="#" id="button-chequeC" data-active="chequeC" data-open="bCaisse" wire:click="$emit('chequeUpdated')" data-section="chequeC">Cheques</a>
                                        </li>
                                        <li class="nav-item" id="beC">
                                            <a class="nav-link" href="#" id="button-beC" data-active="beC" wire:click="$emit('beUpdated')" data-open="bCaisse" data-section="beC">Bon d'entrée</a>
                                        </li>
                                        <li class="nav-item" id="dechargeC">
                                            <a class="nav-link" href="#" id="button-dechargeC" data-active="dechargeC" wire:click="$emit('dechargeUpdated')" data-open="bCaisse" data-section="dechargeC">Decharge</a>
                                        </li>
                                        @endif
                                        
                                        <li class="nav-item" id="rapportC">
                                            <a class="nav-link" href="#" id="button-rapportC" data-active="rapportC" wire:click="$emit('rapportCUpdated')" data-open="bCaisse" data-section="rapportC">Rapport</a>
                                        </li>
                                        <li class="nav-item" id="livreC">
                                            <a class="nav-link" href="#" id="button-livreC" data-active="livreC" wire:click="$emit('livreCaisseUpdated')" data-open="bCaisse" data-section="livreC">Livre de caisse</a>
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
                                        <li class="nav-item" id="tdr">
                                            <a class="nav-link" href="#" id="button-tdr" data-active="tdr" wire:click="$emit('tdrUpdated')" data-open="bProjet" data-section="tdr">Termes de reference</a>
                                        </li>
                                        <li class="nav-item" id="demAchP">
                                            <a class="nav-link" href="#" id="button-demAchP" data-active="demAchP" wire:click="$emit('demAchUpdated')" data-open="bProjet" data-section="demAchP">Demandes d'achat</a>
                                        </li>
                                        <li class="nav-item" id="diP">
                                            <a class="nav-link" href="#" id="button-diP" data-active="diP" wire:click="$emit('diUpdated')" data-open="bProjet" data-section="diP">Demmande interne</a>
                                        </li>
                                        <li class="nav-item" id="bonpayP">
                                            <a class="nav-link" href="#" id="button-bonpayP" data-active="bonpayP" wire:click="$emit('bpUpdated')" data-open="bProjet" data-section="bonpayP">Bons de payement</a>
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
