
<section id="art-section" class="section js-section u-category-media">


 <!-- Content Wrapper. Contains page content -->
  <div class="container">

    <!-- Title -->
        <div class="hk-pg-header align-items-top">
          <div>
            <h3 class="hk-pg-title font-weight-600 mb-10">Agents</h3>
          </div>
          <div class="d-flex">
            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nAgentModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
          </div>
        </div>
    <!-- /Title -->

    <!-- Main content -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="agentTab" class="table table-hover w-100 pb-30">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Matricule</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)


                                <tr>
                                    <td>{{$agent->firstname.' '.$agent->lastname.' '.$agent->middlename}}</td>
                                    <td>{{$agent->matricule}}</td>
                                    <td>{{$agent->phone}}</td>
                                    <td>{{$agent->email}}</td>
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
    </div>

    </div>
</section>


<section id="aff-section" class="section js-section u-category-media">
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Affectations agents</h3>
              </div>

              <div class="d-flex">
                <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nAffectationModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
              </div>
            </div>
        <!-- /Title -->

        <!-- Main content -->
        <!-- Row -->
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table id="affectationTab" class="table table-hover w-100 pb-30">
                            <thead>
                                <tr>
                                    <th>Nom agent</th>
                                    <th>Projet</th>
                                    <th>Poste</th>
                                    <th>Lieu d'affectation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($affectations as $aff)


                                    <tr>
                                        <td>{{App\Models\Agent::firstWhere('id', $aff->agent)->firstname.' '.App\Models\Agent::firstWhere('id', $aff->agent)->lastname}}</td>
                                        <td>{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</td>
                                        <td>{{$aff->poste}}</td>
                                        <td>{{$aff->lieu}}</td>
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
        </div>
        <!-- /Row -->

    </div>
</section>



<section id="mvmt-section" class="section js-section u-category-media">
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Mouvements agents</h3>
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


<section id="recrut-section" class="section js-section u-category-media">
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Recrutements agents</h3>
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









<!-- Modal Agent -->

  <div class="modal fade" id="nAgentModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Nouvel agent</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="registerAgent" class="needs-validation" >
                <div class="modal-body">

                    <div id="messageErrAgent"></div>

                    <div class="form-row">
                        <div class="col-md-4 mb-10">
                            <label for="nameAg">Nom</label>
                            <input type="text" class="form-control" name="name" placeholder="Nom" required>
                            <div class="invalid-feedback">
                                Le nom est obligatoire
                            </div>
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="nameAg2">Postnom</label>
                            <input type="text" class="form-control"  name="name2" placeholder="Postnom" required>
                            <div class="invalid-feedback">
                                Le Postnom est obligatoire
                            </div>
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="nameAg3">Prenom</label>
                            <input type="text" class="form-control" name="name3" placeholder="Prenon">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="service">Service</label>
                            <select class="form-control" name="service" placeholder="Service" required>
                                <option value=""></option>
                                <option value="Administration et finance">Administration et finance</option>
                                <option value="Feminin">Programme</option>
                                <option value="Audit interne">Audit interne</option>
                            </select>
                            <div class="invalid-feedback">
                                Selectionner une service
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="email">Adresse mail</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="Adresse mail" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Entrez un adresse mail valide
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-10">
                            <label for="phone">Numero de telephone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="phone" placeholder="Numero de telephone" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Entrez un numero de telephone valide
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="genre">Genre</label>
                            <select class="form-control" name="genre" placeholder="Genre" required>
                                <option value=""></option>
                                <option value="Masculin">Masculin</option>
                                <option value="Feminin">Feminin</option>
                                <option value="Autre">Autre</option>
                            </select>
                            <div class="invalid-feedback">
                                Selectionner une option
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="etatcivil">Etat civil</label>
                            <select class="form-control" name="etatcivil" placeholder="Etat civil" required>
                                <option value=""></option>
                                <option value="Marie(e)">Marie(e)</option>
                                <option value="Celibataire">Celibataire</option>
                                <option value="Divorce(e)">Divorce(e)</option>
                            </select>
                            <div class="invalid-feedback">
                                Selectionner une option
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="lieuN">Lieu de naissance</label>
                            <input type="text" class="form-control" name="lieuN" placeholder="Lieu de naissance" required>
                            <div class="invalid-feedback">
                                Le lieu de naissance est obligatoire
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="dateN">Date de naissance</label>
                            <input type="date" class="form-control" name="dateN" placeholder="Date de naissance" required>
                            <div class="invalid-feedback">
                                La date de naissance est obligatoires
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" name="region" placeholder="Region">
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="pays">Pays</label>
                            <input type="text" class="form-control" name="pays" placeholder="Pays">
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
                <button class="btn btn-primary" id="btnAg" type="submit">Valider</button>
                <div class="loader-pendulums" id="prldAg" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
              </div>
            </form>
          </div>

      </div>
  </div>


    <!-- Modal Affectation -->
    <div class="modal fade" id="nAffectationModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouvel Affectation</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form  id="registerAffectation" >
                  <div class="modal-body">

                      <div id="messageErrAff"></div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="agent">Selectionner agent</label>
                              <select class="form-control select2" name="agent"  required>
                                  <option value=""></option>

                                  @foreach ($agents as $agent)
                                      <option value="{{$agent->id}}">{{$agent->firstname.' '.$agent->lastname.' '.$agent->middlename}}</option>
                                  @endforeach
                              </select>
                              <div class="invalid-feedback">
                                  Selectionner une option
                              </div>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="projet">Selectionner projet</label>
                              <select class="form-control select2" name="projet" required>
                                <option value=""></option>

                                @foreach ($projets as $projet)
                                    <option value="{{$projet->id}}">{{$projet->name}}</option>
                                @endforeach
                              </select>
                              <div class="invalid-feedback">
                                  Selectionner une option
                              </div>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="poste">Poste</label>
                              <div class="input-group">
                                  <input type="text" class="form-control" name="poste" placeholder="Poste" aria-describedby="inputGroupPrepend" required>
                                  <div class="invalid-feedback">
                                      Preciser le poste
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="lieu">Lieu d'affectation</label>
                              <div class="input-group">
                                  <input type="text" class="form-control" name="lieu" placeholder="Lieu d'affectation" aria-describedby="inputGroupPrepend" required>
                                  <div class="invalid-feedback">
                                      Preciser le lieu
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                      </div>


                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-primary" id="btnAff" type="submit">Valider</button>
                      <div class="loader-pendulums" id="prldAff" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                </div>
              </form>
            </div>
        </div>
    </div>

