<div>
    <section id="bonReqF-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Finance</a></li>
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

            <livewire:finance.bon-req
            searchable="reference,projet"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>

    <section id="demAchF-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Finance</a></li>
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

    <section id="bonComF-section" class="section js-section u-category-media">
      <!-- Breadcrumb -->
      <nav class="hk-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light bg-transparent">
              <li class="breadcrumb-item"><a href="#">Finance</a></li>
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


  <section id="notdebF-section" class="section js-section u-category-media">
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Finance</a></li>
            <li class="breadcrumb-item active" aria-current="page">Notes de debit</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Notes de debit</h3>
              </div>
              <div class="d-flex">
                <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#ndModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
              </div>
            </div>
        <!-- /Title -->
        

        <!-- Main content -->
        <!-- Row -->
        <livewire:finance.note-debit-table searchable="reference" dates="created_at|d-m-Y" exportable/>
        <!-- /Row -->

    </div>
</section>

  <section id="bonpayF-section" class="section js-section u-category-media">
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
        </ul>

          <!-- Tab panes -->
          <div class="tab-content">
          <div id="home" class="container tab-pane active"><br>
            <livewire:finance.bp-table searchable="reference" dates="created_at|d-m-Y" exportable/>
          </div>
          <div id="menu1" class="container tab-pane fade"><br>
            <h6>Menu 1</h6>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
          <div id="menu2" class="container tab-pane fade"><br>
            <h6>Menu 2</h6>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
          </div>
          </div>

       
        
     

    </div>
</section>
</div>
