<div>
    <section id="bonReqS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bons de réquisitions</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
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
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
                <li class="breadcrumb-item active" aria-current="page">Demandes d'achat</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
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




    <section id="pvS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
                <li class="breadcrumb-item active" aria-current="page">PV d'analyse</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">PV d'analyse</h3>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.pv-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            <!-- /Row -->

        </div>
    </section>





    <section id="bonComS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bons de commande</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Bons de commande</h3>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.bc-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            <!-- /Row -->

        </div>
    </section>

    <section id="fournS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fournisseurs</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
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




    <section id="compteS-section" class="section js-section u-category-media">
      <!-- Breadcrumb -->
      <nav class="hk-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light bg-transparent">
              <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
              <li class="breadcrumb-item active" aria-current="page">Compte Fournisseur</li>
          </ol>
      </nav>
      <!-- /Breadcrumb -->
      <!-- Content Wrapper. Contains page content -->
       <div class="container">
          <!-- Title -->
              <div class="hk-pg-header align-items-top">
                <div>
                  <h3 class="hk-pg-title font-weight-600 mb-10">Comptes des fournisseurs</h3>
                </div>
                <div class="d-flex">
                  <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('compteForm')" data-target="#compteModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                </div>
              </div>
          <!-- /Title -->

          <!-- Main content -->
          <!-- Row -->
          <livewire:finance.compte-table />
          <!-- /Row -->

      </div>
  </section>


    

    <section id="prixMarcS-section" class="section js-section u-category-media">
      <!-- Breadcrumb -->
      <nav class="hk-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light bg-transparent">
              <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
              <li class="breadcrumb-item active" aria-current="page">Prix du marche</li>
          </ol>
      </nav>
      <!-- /Breadcrumb -->
      <!-- Content Wrapper. Contains page content -->
       <div class="container">
          <!-- Title -->
              <div class="hk-pg-header align-items-top">
                <div>
                  <h3 class="hk-pg-title font-weight-600 mb-10">Prix du marche par article</h3>
                </div>
                <div class="d-flex">
                  <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('prixForm')" data-target="#prixModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                </div>
              </div>
          <!-- /Title -->

          <!-- Main content -->
          <!-- Row -->
          <livewire:stock.prix-table searchable="reference" dates="created_at|d-m-Y" exportable/>
          <!-- /Row -->

      </div>
  </section>

    <section id="contPrixS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contrat & Prix</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Contrat CARD par article</h3>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('fprixForm')" data-target="#nPrixModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                  </div>
                </div>
            <!-- /Title -->

            <!-- Main content -->
            <!-- Row -->
            <livewire:stock.fprix-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            <!-- /Row -->

        </div>
    </section>

    <section id="entreeS-section" class="section js-section u-category-media">
      <!-- Breadcrumb -->
      <nav class="hk-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light bg-transparent">
              <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
              <li class="breadcrumb-item active" aria-current="page">Bons de reception</li>
          </ol>
      </nav>
      <!-- /Breadcrumb -->
      <!-- Content Wrapper. Contains page content -->
       <div class="container">
          <!-- Title -->
              <div class="hk-pg-header align-items-top">
                <div>
                  <h3 class="hk-pg-title font-weight-600 mb-10">Bons de reception</h3>
                </div>
              </div>
          <!-- /Title -->

          <!-- Main content -->
          <!-- Row -->
          <livewire:stock.br-table searchable="reference" dates="created_at|d-m-Y" exportable/>
          <!-- /Row -->

      </div>
  </section>

  <section id="diS-section" class="section js-section u-category-media">
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

  <section id="invS-section" class="section js-section u-category-media">
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Stock & Logistique</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inventaire</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Inventaire</h3>
              </div>
            </div>
        <!-- /Title -->

        <!-- Main content -->
        <!-- Row -->
        <livewire:stock.inventaire-table  dates="created_at|d-m-Y" exportable/>
        <!-- /Row -->

    </div>
  </section>

</div>

