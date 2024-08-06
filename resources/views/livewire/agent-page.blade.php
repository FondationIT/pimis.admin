<div>

    <section id="profil-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{Auth::user()->name}}</li>
            </ol>
        </nav>
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="">
                  <div class="row">
                    <div class="col-lg-9">
                        <div class="media align-items-center">
                            <div class="d-flex media-img-wrap mr-15">
                                <div class="avatar avatar-xl">
                                    <span class="avatar-text avatar-text-inv-pink rounded-circle"><span class="initial-wrap"><span>{{substr(Auth::user()->name, 0, 1)}}</span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="media-body">
                        
                                    <div class="text-capitalize display-6 mb-5 font-weight-400">{{Auth::user()->name}}</div>
                                    <div class="font-14">
                                        <span class="mr-5">
                                            @if($agent->gender == 'Masculin')
                                                <span class="mr-5">Homme</span>    
                                            @else
                                                <span class="mr-5">Femme</span>  
                                            @endif
                                        </span>
                                        <span class="mr-5"> / {{$statut->etatcivil}}</span>
                                        <span class="mr-5">
                                            /  
                                            @if (Auth::user()->role == 'Sup')SUPER USER @endif
                                            @if (Auth::user()->role == 'ADMIN')ADMIN @endif
                                            @if (Auth::user()->role == 'S.E')EXECUTIVE @endif
                                            @if (Auth::user()->role == 'D.A.F')DAF @endif
                                            @if (Auth::user()->role == 'D.P')PROGRAMME @endif
                                            @if (Auth::user()->role == 'C.P')PROJET @endif
                                            @if (Auth::user()->role == 'R.H')RESOURCES HUMAINES @endif
                                            @if (Auth::user()->role == 'A.I')AUDIT INTERNE @endif
                                            @if (Auth::user()->role == 'COMPT1')COMTABILITE @endif
                                            @if (Auth::user()->role == 'COMPT2')CHEF COMPTABLE @endif
                                            @if (Auth::user()->role == 'CAISS')CAISSSE @endif
                                            @if (Auth::user()->role == 'LOG1')LOGISTIQUE DIRECTION @endif
                                            @if (Auth::user()->role == 'LOG2')LOGISTIQUE OPERATION @endif
                                            @if (Auth::user()->role == 'MAG')MAGASIN @endif
                                            @if (Auth::user()->role == 'SECU')SECURITE @endif
                                        </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="font-14"><span>SIGNATURE</span></div>
                        <div style="background: #fff;border: 1px solid #ccc;text-align: center;">
                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', Auth::user()->id)->signature)}}" style="position: relative;width:150px;text-align: center;margin:auto;padding:5px;" />
                        </div>
                    </div>
                  </div>
                    
                </div><hr>
                    <div class="container">
                        <div class="hk-row">
                            <div class="col-lg-8">
                                <div class="card card-profile-feed">
                                    <div class="card-header card-header-action">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <div class="text-capitalize font-weight-500 text-dark">Informations</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row text-center">
                                                @if($agent)
                                                <div class="col-4 border-right pr-0">
                                                    <div class="pa-15">
                                                        <span class="d-block display-6 text-dark mb-5">{{$nc}}</span>
                                                        <span class="d-block text-capitalize font-14">Contrats</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 border-right px-0">
                                                    <div class="pa-15">
                                                        <span class="d-block display-6 text-dark mb-5">{{$na}}</span>
                                                        <span class="d-block text-capitalize font-14">Affectations</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 pl-0">
                                                    <div class="pa-15">
                                                        <span class="d-block display-6 text-dark mb-5">{{$statut->enfant}}</span>
                                                        <span class="d-block text-capitalize font-14">Enfants</span>
                                                    </div>
                                                </div>
                                                @endif
                                            </div><hr>
                                            <div class="row text-center">
                                                <div class="col-4 border-right pr-0">
                                                    <div class="pa-15">
                                                        <p><strong><u>Infornations demographiques</u></strong></p><br>
                                                        @if($agent)
                                                        <p>
                                                            <strong>Date et lieu de naissance:</strong>
                                                            <br><span class="d-block text-capitalize font-14">{{$agent->lieu}}  {{$agent->birthdate}}</span>
                                                        </p><br>
                                                        
                                                        <p>
                                                            <strong>Adresse</strong>
                                                            <br><span class="d-block text-capitalize font-14">{{$agent->adress}}  {{$agent->region}} {{$agent->country}}</span>
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-8 px-0">
                                                    <div class="pa-15">
                                                        <p><strong><u>Informations proffetionnelles</u></strong></p><br>
                                                        <div class="row">
                                                            <div class="col-lg-6 border-right pa-15" style="text-align: center">  
                                                             <strong>Affectation</strong><br>
                                                             @if(!empty($affectation[0]))
                                                                <div style="padding:10px;text-align:right">
                                                                    @foreach ($affectation as $aff)
                                                                        <p><strong>Projet: </strong><span class="text-capitalize font-14">{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</span></p>                   
                                                                        <p><strong>Poste: </strong><span class="text-capitalize font-14">{{$aff->poste}}</span><br>
                                                                        <strong>Lieu: </strong><span class="text-capitalize font-14">{{$aff->lieu}}</span></p><br>
                                                                    @endforeach
                                                                </div> 
                                                             @else
                                                                <span class="text-capitalize font-14">Aucune affectation</span>     
                                                             @endif
                                                            </div>
                                                            <div class="col-lg-6 pa-15" style="text-align: center">
                                                                <strong>Contrat:</strong><br>
                                                                 @if(!empty($contrat[0]))
                                                                    <div style="padding:10px;text-align:left">
                                                                        <p><strong>Statut: </strong>{{$contrat[0]->satatut}}</p>
                                                                        <p><strong>Type: </strong>{{$contrat[0]->type}}</p>
                                                                        <p><strong>Debut: </strong>{{$contrat[0]->debut}}</p>
                                                                        <p><strong>Fin: </strong>{{$contrat[0]->fin}}</p>
                                                                        <p><strong>Projet: </strong>{{App\Models\Projet::firstWhere('id', $contrat[0]->projet)->name}}</p>
                                                                    </div>
                                                                 @else
                                                                    <span class="text-capitalize font-14">Aucun contrat en cours</span> 
                                                                 @endif
                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><hr>
                                            <div class="row"> 
                                                <div class="col-lg-12" style="text-align: center">
                                                    <p>
                                                        <strong>Personne à contacter</strong>
                                                        <br>
                                                        @if(!empty($agent->nom2))
                                                        <strong>Nom: </strong>{{$agent->nom2}}<br>
                                                        <strong>Tel: </strong>{{$agent->contact}}
                                                        @else
                                                        <span class="text-capitalize font-14">Aucune personne</span>     
                                                        @endif
                    
                                                    </p>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                
                                <div class="card card-profile-feed">
                                    <div class="card-header card-header-action">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <div class="text-capitalize font-weight-500 text-dark">Changer mot de passe</div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="card-body">
                                        <livewire:auth.reset-pass />
                                    </div>
                                </div>
                                <div class="card card-profile-feed">
                                    <div class="card-body">
                                        <p>Le mot de passe doit etre constituer :</p>
                                        
                                            <li>Au moin 8 caracteres</li>
                                            <li>Au moin une lettre majicule</li>
                                            <li>Au moin une lettre miniscule</li>
                                            <li>Au moin un chifre</li>
                                            <li>Au moin un caractere special (symbole)</li>
                                    </div>
                                        
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
           
            <!-- /Row -->
    </section>

    <section id="aCatPrix-section" class="section js-section u-category-media">

        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Catalogue de prix</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
        <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Catalogue de prix</h3>
                  </div>
                  @if (Auth::user()->role == 'LOG1' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                    <div class="d-flex">

                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" wire:click="$emit('articleForm')" data-toggle="modal" data-target="#articleModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>

                    </div>
                  @endif
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            
                <livewire:stock.article-table
                exportable
                />
            
            <!-- /Row -->

        </div>
    </section>

    <section id="catProd-section" class="section js-section u-category-media">

        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categorie & Produit</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
        <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Categorie & Produit</h3>
                  </div>
                  @if (Auth::user()->role == 'LOG1' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" wire:click="$emit('categorieForm')" data-toggle="modal" data-target="#nCategorieModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Categorie </span></button>

                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" wire:click="$emit('productForm')" data-toggle="modal" data-target="#nProductModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Produit </span></button>

                    </div>
                  @endif
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        
                        <div class="col-md-6 col-sm-12">
                            <h4>Categories</h4>
                            <div >
                                <livewire:stock.categories-table
                                />
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">

                            <h4>Produits</h4>
                            <div >
                                <livewire:stock.products-table
                                exportable
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->

        </div>
    </section>


    <section id="fichSt-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fiche de stock</li>
            </ol>
        </nav>
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Fiche de stock</h3>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.stock-table
            searchable="reference,projet"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>



    <section id="etBes-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Etat de besoin</li>
            </ol>
        </nav>
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Etat de besoin</h3>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('ebForm')" data-target="#nEtBesModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            
            <div class="card">
                <h6 class="card-header d-flex align-items-center">
                    <i class="ion ion-md-funnel font-30 mr-10"></i>Filtre
                </h6>
                <div class="card-body">
                    <livewire:filter.eb-filter>
                </div>
            </div>
       
            <div class="card">
                <div class="card-body">
                    <livewire:agent.eb-table 
                    wire:key='{{now()}}'
                    dates="created_at|d-m-Y"
                    exportable 
                    />
                </div>
            </div>
            <!-- /Row -->

        </div>
    </section>





    <section id="tdr-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terme de reference</li>
            </ol>
        </nav>
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Terme de reference</h3>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('trForm')" data-target="#trModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:agent.tr-table 
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>






    <section id="di-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Demmande Interne</li>
            </ol>
        </nav>
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Demmande Interne</h3>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('diForm')" data-target="#diModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.di-table
            searchable="reference,projet"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>








    <section id="usMvmt-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mouvement</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">

            
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Mouvement</h3>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('mvntForm')" data-target="#mvntModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->

            <livewire:agent.mvmt-table
            searchable="reference"
            exportable
            />

            <!-- /Row -->

        </div>
    </section>

    <section id="conge-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Informations generales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Conges</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Conges personnels</h3>
                     </div>

                     <div class="d-flex">
                      <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('congeForm')" data-target="#congeModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->

                <livewire:agent.conge-table
                searchable="reference"
                exportable
                />

               <!-- /Row -->

           </div>
       </section>

  

    <livewire:agent.eb-form />
    <livewire:agent.eb-print />
    <livewire:stock.da-print />
    <livewire:agent.di-form />
</div>

