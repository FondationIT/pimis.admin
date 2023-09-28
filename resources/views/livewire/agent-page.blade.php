<div>

    <section id="aCatPrix-section" class="section js-section u-category-media">

        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
                searchable="product, reference"
                exportable
                />
            
            <!-- /Row -->

        </div>
    </section>

    <section id="catProd-section" class="section js-section u-category-media">

        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
                                model="App\Models\Categorie"
                                />
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">

                            <h4>Produits</h4>
                            <div >
                                <livewire:stock.products-table
                                searchable="agent, projet, lieu"
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
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
            <livewire:agent.eb-table
            searchable="reference,projet"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>





    <section id="tdr-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
            <livewire:agent.tr-table />
            <!-- /Row -->

        </div>
    </section>






    <section id="di-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
            <div class="row">

            <livewire:agent.mvmt-table
            searchable="reference"
            exportable
            />

            </div>
            <!-- /Row -->

        </div>
    </section>

    <section id="conge-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
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
               <div class="row">

                <livewire:agent.conge-table
            searchable="reference"
            exportable
            />

               </div>
               <!-- /Row -->

           </div>
       </section>

  

    <livewire:agent.eb-form />
    <livewire:agent.eb-print />
    <livewire:stock.da-print />
    <livewire:agent.di-form />
</div>

