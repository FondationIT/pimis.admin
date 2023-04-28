<div>
    <section id="bonReqS-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Bons de réquisitions</h3>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->

            <livewire:finance.bon-req
            searchable="reference,projet"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>

    <section id="demAchS-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Demandes d'achat</h3>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->

            <livewire:stock.da-table
            searchable="reference,eb"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>

    <section id="fournS-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Fournisseurs</h3>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('fournisseurForm')" data-target="#nFournisseurModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.fournisseurs-table
            searchable="reference"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>

    <section id="contPrixS-section" class="section js-section u-category-media">
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Prix</h3>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('prixForm')" data-target="#nPrixModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.prix-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            <!-- /Row -->

        </div>
    </section>
</div>
