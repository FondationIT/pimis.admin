<div>
    <section id="bonpayC-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Finance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bons de payement</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
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



    <section id="chequeC-section" class="section js-section u-category-media">
      <!-- Breadcrumb -->
      <nav class="hk-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light bg-transparent">
              <li class="breadcrumb-item"><a href="#">Caisse</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cheques</li>
          </ol>
      </nav>
      <!-- /Breadcrumb -->
      <!-- Content Wrapper. Contains page content -->
      <div class="container">
          <!-- Title -->
              <div class="hk-pg-header align-items-top">
                <div>
                  <h3 class="hk-pg-title font-weight-600 mb-10">Cheques</h3>
                </div>
                <div class="d-flex">
                  
                </div>
              </div>
          <!-- /Title -->
          
  
          <!-- Main content -->
          <!-- Row -->
          <livewire:finance.cheque-table />
          <!-- /Row -->
  
      </div>
    </section>



    <section id="beC-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Caisse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bon d'entrée</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Bon d'entrée</h3>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('beForm')" data-target="#beModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                  </div>
                </div>
            <!-- /Title -->
            
    
            <!-- Main content -->
            <!-- Row -->
            <livewire:caisse.be-table />
            <!-- /Row -->
    
        </div>
    </section>




    <section id="dechargeC-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Caisse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Decharge</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Decharge</h3>
                  </div>
                  <div class="d-flex">
                    
                  </div>
                </div>
            <!-- /Title -->
            
    
            <!-- Main content -->
            <!-- Row -->
            <livewire:caisse.decharge-table />
            <!-- /Row -->
    
        </div>
    </section>



    <section id="rapportC-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Caisse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rapport</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Rapport</h3>
                  </div>
                  
                </div>
            <!-- /Title -->
            
    
            <!-- Main content -->
            <!-- Row -->
            <livewire:caisse.rapport-table />
            <!-- /Row -->
    
        </div>
    </section>

    <section id="livreC-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Caisse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Livre de caisse</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Content Wrapper. Contains page content -->
         <div class="container">
            <!-- Title -->
                <div class="hk-pg-header align-items-top">
                  <div>
                    <h3 class="hk-pg-title font-weight-600 mb-10">Livre de caisse</h3>
                  </div>
                  
                  
                </div>
            <!-- /Title -->
            
    
            <!-- Main content -->
            <livewire:caisse.filtre />
            <!-- Row -->
            <livewire:caisse.livre-caisse />
            <!-- /Row -->
    
        </div>
    </section>
</div>
