<section id="pres-section" class="section js-section ">


 <!-- Content Wrapper. Contains page content -->
  <div class="container">




    <!-- Title -->
        <div class="hk-pg-header align-items-top">
          <div>
            <h3 class="hk-pg-title font-weight-600 mb-10">Presentation</h3>
          </div>
          <div class="d-flex">
            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15"><span class="icon-label"><i class="fa fa-print"></i> </span><span class="btn-text">Print </span></button>
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










<section id="resp-section" class="section js-section u-category-media">


 <!-- Content Wrapper. Contains page content -->
  <div class="container">

    <!-- Title -->
        <div class="hk-pg-header align-items-top">
          <div>
            <h3 class="hk-pg-title font-weight-600 mb-10">Responsable</h3>
          </div>
          <div class="d-flex">
            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nResponsableModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15"><span class="icon-label"><i class="fa fa-print"></i> </span><span class="btn-text">Print </span></button>
          </div>
        </div>
    <!-- /Title -->

    <!-- Main content -->
    <!-- Row -->
      <div class="row"></div>

    </div>
</section>








<section id="agen-section" class="section js-section u-category-media">

 <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Agenda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Agenda</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</section>




<section id="serv-section" class="section js-section u-category-media">

 <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Services</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Services</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</section>



<!-- Modal Presentation -->
  <div class="modal fade" id="presentationModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Presentation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-presentation">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" id="data-presentation" >
                          @isset($pres)
                            {!! $pres[0]->data !!}
                          @endisset
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Modal Historique -->
  <div class="modal fade" id="historiqueModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Historique</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-historique">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" id="data-historique" >
                          @isset($his)
                            {!! $his[0]->data !!}
                          @endisset
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>


  <!-- Modal Vision -->
  <div class="modal fade" id="visionModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Vision</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-vision">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" id="data-vision" >
                          @isset($vis)
                            {!! $vis[0]->data !!}
                          @endisset
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>


  <!-- Modal Doctrine -->
  <div class="modal fade" id="doctrineModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Doctrine</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-doctrine">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" required ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>



   <!-- Modal Nouvel responsable -->
  <div class="modal fade" id="nResponsableModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalForms" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Responsable</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-responsable">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nom complet</label>
                        <input type="text" class="form-control" id="" placeholder="Nane" required>
                    </div>
                    <div class="form-group">
                        <label for="">Adresse mail</label>
                        <input type="mail" class="form-control" id="" placeholder="Nane" required>
                    </div>
                    <div class="form-group">
                        <label for="">Fonction</label>
                        <select class="form-control custom-select  mt-15" required>
                            <option selected>Select</option>
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            <option value="3">Associé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Detail</label>
                        <textarea class="form-control" required ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>

