<section id="catPrix-section" class="section js-section u-category-media">
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Catalogue de prix</h3>
              </div>
              @if (Auth::user()->role == 'LOG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                <div class="d-flex">
                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nProductModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Produit </span></button>

                    <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nCategorieModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Categorie </span></button>
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
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="cateorieTab" class="table table-hover w-100 pb-30">
                                    <thead>
                                        <tr>
                                            <th>Nom </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $cat)


                                            <tr>
                                                <td>{{$cat->name}}</td>
                                                <td>
                                                    <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                                                    <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="icon-trash txt-danger"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12">
                    @else
                    <div class="col-md-12 col-sm-12">
                    @endif


                        <h4>Produits</h4>
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="productTab" class="table table-hover w-100 pb-30">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Categrie</th>
                                            <th>Unité</th>
                                            <th>Prix</th>
                                            @if (Auth::user()->role == 'LOG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $prod)


                                            <tr>
                                                <td>{{$prod->designation}}</td>
                                                <td>{{App\Models\Categorie::firstWhere('id', $prod->categorie)->name}}</td>
                                                <td>{{'1 '.$prod->unite}}</td>
                                                <td>{{'$'.$prod->prix}}</td>
                                                @if (Auth::user()->role == 'LOG' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup')
                                                <td>
                                                    <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                                                    <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="icon-trash txt-danger"></i> </a>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

    </div>
</section>


<!-- Modal Produit -->

<div class="modal fade" id="nProductModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="registerProduct" class="needs-validation" >
              <div class="modal-body">

                  <div id="messageErrProd"></div>
                  <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="categorie">Selectionner categorie *</label>
                        <select class="form-control select2" name="categorie"  required>
                            <option value=""></option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Selectionner une option
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="designation">Designation *</label>
                        <input type="text" class="form-control" name="designation" placeholder="Designation" required>
                        <div class="invalid-feedback">
                            La designation est obligatoire
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="model">Marque *</label>
                        <input type="text" class="form-control" name="model" placeholder="Marque" required>
                        <div class="invalid-feedback">
                            Ce champ est obligatoire
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-10">
                        <label for="unite">Unité *</label>
                        <input type="text" class="form-control" name="unite" placeholder="Unité" required>
                        <div class="invalid-feedback">
                            Ce champ est obligatoire
                        </div>
                    </div>
                    <div class="col-md-6 mb-10">
                        <label for="prix">Prix unitaire</label>
                        <input type="text" class="form-control" name="prix" placeholder="Prix unitaire">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btnProd" type="submit">Valider</button>
              <div class="loader-pendulums" id="prldProd" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
            </div>
          </form>
        </div>

    </div>
</div>


<!-- Modal Categorie -->

<div class="modal fade" id="nCategorieModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle categorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="registerCategorie" class="needs-validation" >
              <div class="modal-body">

                  <div id="messageErrCat"></div>

                 <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="name">Nom *</label>
                        <input type="text" class="form-control" name="name" placeholder="Nom" required>
                        <div class="invalid-feedback">
                            Le nom est obligatoire
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-10">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
              </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btnCat" type="submit">Valider</button>
              <div class="loader-pendulums" id="prldCat" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
            </div>
          </form>
        </div>

    </div>
</div>



