<div>
    <section id="pres-section" class="section js-section ">


 <!-- Content Wrapper. Contains page content -->
  <div class="container">




    <!-- Title -->
        <div class="hk-pg-header align-items-top">
          <div>
            <h3 class="hk-pg-title font-weight-600 mb-10">Presentation</h3>
          </div>
        </div>
    <!-- /Title -->

    <!-- Main content -->
    <!-- Row -->
      <div class="row">
          <div class="col-xl-12">
            <div class="hk-row">
              <div class="col-lg-6">

                <div class="card card-refresh">
                  <div class="refresh-container">
                    <div class="loader-pendulums"></div>
                  </div>
                  <div class="card-header card-header-action">
                    <h6>Presentation</h6>
                    <div class="d-flex align-items-center card-action-wrap">
                      <a href="#" class="inline-block refresh mr-15">
                        <i class="ion ion-md-radio-button-off"></i>
                      </a>
                      <div class="inline-block dropdown">
                        <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#presentationModalEditor">Ajouter/Modifier</button>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Suprimer</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body" id="aff-presentation">
                    @isset($pres)
                      {!! $pres[0]->data !!}
                    @endisset
                  </div>
                </div>



                <div class="card card-refresh">
                  <div class="refresh-container">
                    <div class="loader-pendulums"></div>
                  </div>
                  <div class="card-header card-header-action">
                    <h6>Termes de Confidentialité</h6>
                    <div class="d-flex align-items-center card-action-wrap">
                      <a href="#" class="inline-block refresh mr-15">
                        <i class="ion ion-md-radio-button-off"></i>
                      </a>
                      <div class="inline-block dropdown">
                        <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#visionModalEditor">Ajouter/Modifier</button>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Suprimer</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-body" id="aff-vision">
                    @isset($vis)
                      {!! $vis[0]->data !!}
                    @endisset
                  </div>
                </div>

              </div>


              <div class="col-lg-6">

               <div class="card card-refresh">
                  <div class="refresh-container">
                    <div class="loader-pendulums"></div>
                  </div>
                  <div class="card-header card-header-action">
                    <h6>Condition d'utilisation</h6>
                    <div class="d-flex align-items-center card-action-wrap">
                      <a href="#" class="inline-block refresh mr-15">
                        <i class="ion ion-md-radio-button-off"></i>
                      </a>
                      <div class="inline-block dropdown">
                        <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#historiqueModalEditor">Ajouter/Modifier</button>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Suprimer</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-body" id="aff-historique">
                    @isset($his)
                      {!! $his[0]->data !!}
                    @endisset
                  </div>
                </div>



              </div>
            </div>
          </div>
        </div>
    <!-- /Row -->

  </div>
</section>









<section id="userB-section" class="section js-section u-category-media">

    <!-- Content Wrapper. Contains page content -->
     <div class="container">

       <!-- Title -->
           <div class="hk-pg-header align-items-top">
             <div>
               <h3 class="hk-pg-title font-weight-600 mb-10">Utilisateurs</h3>
             </div>
             <div class="d-flex">
               <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nUserModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
             </div>
           </div>
       <!-- /Title -->

       <!-- Main content -->
       <!-- Row -->
       <div class="row">
        <div class="col-sm">
            <livewire:pimis.users-table />
        </div>
       </div>
    </div>
</section>










<section id="resp-section" class="section js-section u-category-media">
 <!-- Content Wrapper. Contains page content -->
 <div class="container">




    <!-- Title -->
        <div class="hk-pg-header align-items-top">
          <div>
            <h3 class="hk-pg-title font-weight-600 mb-10">Bailleurs</h3>
          </div>
          <div class="d-flex">
            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nBailleursModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
          </div>
        </div>
    <!-- /Title -->

    <!-- Main content -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm">
            <livewire:pimis.bailleurs-table />
        </div>
    </div>
    <!-- /Row -->

  </div>
</section>












<section id="serv-section" class="section js-section u-category-media">
<!-- Content Wrapper. Contains page content -->
 <div class="container">




    <!-- Title -->
        <div class="hk-pg-header align-items-top">
          <div>
            <h3 class="hk-pg-title font-weight-600 mb-10">Projets</h3>
          </div>

          <div class="d-flex">
            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nProjectModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
          </div>
        </div>
    <!-- /Title -->

    <!-- Main content -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm">
            <livewire:pimis.projects-table />
        </div>
    </div>
    <!-- /Row -->

  </div>


</section>
<livewire:pimis.user-form />
<livewire:pimis.bailleur-form />
<livewire:pimis.project-form />
</div>


