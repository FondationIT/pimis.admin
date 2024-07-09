<div>
    <section id="bonReqP-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Projet</a></li>
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

                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nEtBesModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
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
                  <livewire:filter.bon-req-filter>
              </div>
          </div>
     
          <div class="card">
              <div class="card-body">
                  <livewire:finance.bon-req 
                  wire:key='{{now()}}'
                  searchable="reference,projet"
                  dates="created_at|d-m-Y"
                  exportable 
                  />
              </div>
          </div>
          <!-- /Row -->

        </div>
    </section>


    <section id="demAchP-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Projet</a></li>
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
            
            <div class="card">
              <h6 class="card-header d-flex align-items-center">
                  <i class="ion ion-md-funnel font-30 mr-10"></i>Filtre
              </h6>
              <div class="card-body">
                  <livewire:filter.da-filter>
              </div>
          </div>
     
          <div class="card">
              <div class="card-body">
                  <livewire:stock.da-table 
                  wire:key='{{now()}}'
                  searchable="reference,projet"
                  dates="created_at|d-m-Y"
                  exportable 
                  />
              </div>
          </div>
          <!-- /Row -->

        </div>
    </section>

    <section id="diP-section" class="section js-section u-category-media">
      <!-- Breadcrumb -->
      <nav class="hk-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light bg-transparent">
              <li class="breadcrumb-item"><a href="#">Projet</a></li>
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

  <section id="bonpayP-section" class="section js-section u-category-media">
    <!-- Breadcrumb -->
    <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Bons de payement</h3>
              </div>
            </div>
        <!-- /Title -->


        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Achat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Note de debit</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">TDR</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu4">Approvisionnement caisse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu3">Salaire agents</a>
          </li>
        </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
              <h5>Bon de paiement des achats</h5>
              <livewire:finance.bp-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            </div>
            <div id="menu1" class="container tab-pane fade"><br>
              <h5>Bon de paiement des notes de debit</h5>
              <livewire:finance.bp4-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
              <h5>Bon de paiement des TDR</h5>
              <livewire:finance.bp3-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            </div>
            <div id="menu3" class="container tab-pane fade"><br>
              <h5>Bon de paiement des salaires</h5>
              <livewire:finance.bp6-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            </div>   
            <div id="menu4" class="container tab-pane fade"><br>
              <h5>Bon de paiement approvionnement caisse</h5>
              <livewire:finance.bp5-table searchable="reference" dates="created_at|d-m-Y" exportable/>
            </div>
          </div>

       
        
     

    </div>

   
    
 

</section>

<section id="congeP-section" class="section js-section u-category-media">
  <!-- Breadcrumb -->
  <nav class="hk-breadcrumb" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-light bg-transparent">
          <li class="breadcrumb-item"><a href="#">Projet</a></li>
          <li class="breadcrumb-item active" aria-current="page">Conges</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Conges agents</h3>
                     </div>

                     <div class="d-flex">
                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('conge2Form')" data-target="#conge2ModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
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
</div>
