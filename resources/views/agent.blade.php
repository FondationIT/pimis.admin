<section id="etBes-section" class="section js-section u-category-media">
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Etat de besoin</h3>
              </div>

              <div class="d-flex">
                <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nEtBesModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
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
        <div class="row">

        </div>
        <!-- /Row -->

    </div>
</section>



<!-- Modal Etat de besion -->

<div class="modal fade" id="nEtBesModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel Etat de besoin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="registerEtBes" class="needs-validation" >
              <div class="modal-body">
                <div id="messageErrEtBes"></div>

                <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <input type="text" class="form-control" id="agentEB" disabled value="{{ Auth::user()->name }}" >
                    </div>
                </div>
                <div class="form-row">
                    <input type="text"  id="allProdPlus" hidden value="{{$products}}" >
                    <div class="col-md-3 mb-10">
                        <label for="product">Produit</label>
                          <select class="form-control select2 prodEB" id="prodEB1" name="product" onchange="afficheEBChoix(this.value,1)" required>

                          </select>
                          <div class="invalid-feedback">
                              Selectionner un produit
                          </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label for="username">Quantité</label>
                          <div class="input-group">
                              <input type="number" class="form-control QteEB" name="username"  aria-describedby="inputGroupPrepend" required>
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="unite-1"></span>
                              </div>
                              <div class="invalid-feedback">
                                  Le nom d'utilisateur est obligatoire
                              </div>
                          </div>
                    </div>
                    <div class="col-md-5 mb-10">
                        <label for="description">Aspects spécifiques</label>
                        <textarea class="form-control descEB" name="description" id="prodE1"></textarea>
                    </div>


                    <div class="col-md-1 mb-10">

                    </div>
                </div>
                <div id="autreEB">
                </div>
                <button class="button btn btn-primary" id="eBAdd" style="float: right;">+</button>

                <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="commentEB">Commentaire</label>
                        <textarea class="form-control" name="commentEB" id="commentEB"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btnEtBes" type="submit">Valider</button>
              <div class="loader-pendulums" id="prldEtBes" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
            </div>
          </form>
        </div>

    </div>
</div>
