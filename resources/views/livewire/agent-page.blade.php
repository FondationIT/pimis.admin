<div>

    <section id="aCatPrix-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
        <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Catalogue de prix</h3>
                  </div>
                  @if (Auth::user()->role == 'LOG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
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
                        @if (Auth::user()->role == 'LOG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                        <div class="col-md-4 col-sm-12">
                            <h4>Categories</h4>
                            <div >
                                <livewire:stock.categories-table
                                model="App\Models\Categorie"
                                />
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12">
                        @else
                        <div class="col-md-12 col-sm-12">
                        @endif


                            <h4>Produits</h4>
                            <div >
                                <livewire:stock.products-table
                                model="App\Models\Product"
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



    <section id="etBes-section" class="section js-section u-category-media">
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


    <section id="usMvmt-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Mouvement</h3>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <div class="row">

            </div>
            <!-- /Row -->

        </div>
    </section>

    <section id="contr-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Contrat</h3>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->

            <!-- /Row -->

        </div>
    </section>

    <livewire:agent.eb-form />
    <livewire:agent.eb-print />
    <livewire:stock.da-print />
</div>
