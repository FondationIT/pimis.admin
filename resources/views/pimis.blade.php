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
               <div class="table-wrap">
                   <div class="table-responsive">
                       <table id="userTab" class="table table-hover w-100 pb-30">
                           <thead>
                               <tr>
                                   <th>Nom complet</th>
                                   <th>Email</th>
                                   <th>Role</th>
                                   <th>Status</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($users as $user)


                                   <tr>
                                       <td>{{$user->name}}</td>
                                       <td>{{$user->email}}</td>
                                       <td>{{$user->role}}</td>
                                       <td>{{$user->active}}</td>
                                       <td>
                                           <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Detail"> <i class="icon-eye"></i> </a>
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
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="bailleurTab" class="table table-hover w-100 pb-30">
                        <thead>
                            <tr>
                                <th>Nom </th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bailleurs as $bailleur)


                                <tr>
                                    <td>{{$bailleur->name}}</td>
                                    <td>{{$bailleur->email}}</td>
                                    <td>{{$bailleur->phone}}</td>
                                    <td>{{$bailleur->active}}</td>
                                    <td>
                                        <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Detail"> <i class="icon-eye"></i> </a>
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
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="projetTab" class="table table-hover w-100 pb-30">
                        <thead>
                            <tr>
                                <th>Nom </th>
                                <th>Date debut</th>
                                <th>Date fin</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projets as $projet)


                                <tr>
                                    <td>{{$projet->name}}</td>
                                    <td>{{$projet->dateD}}</td>
                                    <td>{{$projet->dateF}}</td>
                                    <td>{{$projet->active}}</td>
                                    <td>
                                        <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Detail"> <i class="icon-eye"></i> </a>
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




  <!-- Modal User -->
  <div class="modal fade" id="nUserModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Nouvel Utilisateur</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form  id="registerUser" >
              <div class="modal-body">

                  <div id="messageErrUs"></div>

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
                          <label for="role">Selectionner role</label>
                          <select class="form-control select2" name="role" required>
                              <option value=""></option>
                              <option value="PERS">PERS</option>
                              <option value="SECU">SECU</option>
                              <option value="MAG">MAG</option>
                              <option value="LOG">LOG</option>
                              <option value="CAISS">CAISS</option>
                              <option value="COMPT">COMPT</option>
                              <option value="A.I">A.I</option>
                              <option value="R.H">R.H</option>
                              <option value="C.P">C.P</option>
                              <option value="D.P">D.P</option>
                              <option value="D.A.F">D.A.F</option>
                              <option value="S.E">S.E</option>
                              <option value="ADMIN">ADMIN</option>
                          </select>
                          <div class="invalid-feedback">
                              Selectionner une option
                          </div>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="col-md-12 mb-10">
                          <label for="username">Nom d'utilisateur</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupPrepend"><i class="icon-user"></i></span>
                              </div>
                              <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                  Le nom d'utilisateur est obligatoire
                              </div>
                          </div>
                      </div>
                  </div>


              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" id="btnUs" type="submit">Valider</button>
                  <div class="loader-pendulums" id="prldUs" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
            </div>
          </form>
        </div>
    </div>
</div>







  <!-- Modal Project -->
  <div class="modal fade" id="nProjectModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Nouveau projet</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form  id="registerProjet" class="needs-validation">

                <div class="modal-body">

                    <div id="messageErrPojet"></div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="nameAg">Nom du projet *</label>
                            <input type="text" class="form-control" name="name" placeholder="Nom du projet" required>
                            <div class="invalid-feedback">
                                Le nom est obligatoire
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="email">Date Debut *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control" name="dateD" placeholder="Date debut" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Preciser la date du debut
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="email">Date Fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control" name="dateF" placeholder="Date fin" aria-describedby="inputGroupPrepend">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="domaine">Domaine d'intervention *</label>
                            <select class="form-control" name="domaine" placeholder="" required>
                                <option value=""></option>
                                <option value="Masculin">Sante</option>
                                <option value="Feminin">Securite allimentaire</option>
                                <option value="Autre">Education</option>
                            </select>
                            <div class="invalid-feedback">
                                Selectionner une option
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="bailleur">Bailleur *</label>
                            <select class="form-control" name="bailleur" placeholder="" required>
                                <option value=""></option>

                                @foreach ($bailleurs as $bailleur)
                                    <option value="{{$bailleur->id}}">{{$bailleur->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Selectionner une option
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="contexte">Contexte</label>
                            <div class="tinymce-wrap">
                                <textarea class="tinymce" id="contexteProjet" ></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" id="btnPjt" type="submit">Valider</button>
                <div class="loader-pendulums" id="prldPjt" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Modal Bailleurs -->
<div class="modal fade" id="nBailleursModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Nouveau bailleur</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form  id="registerBailleur" class="needs-validation">

                <div class="modal-body">

                    <div id="messageErrBailleur"></div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="name">Nom du bailleur *</label>
                            <input type="text" class="form-control" name="name" placeholder="Nom du bailleur" required>
                            <div class="invalid-feedback">
                                Le nom est obligatoire
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="email">Adresse mail *</label>
                            <input type="email" class="form-control" name="email" placeholder="Adresse mail" required>
                            <div class="invalid-feedback">
                                Adresse mail incorrecte
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="phone">Numero de telephone *</label>
                            <input type="text" class="form-control" name="phone" placeholder="Numero de telephone" required>
                            <div class="invalid-feedback">
                                Numero de telephone incorrecte
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="adresse">Adresse *</label>
                            <input type="text" class="form-control" name="adresse" placeholder="Adresse">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" id="btnBail" type="submit">Valider</button>
                <div class="loader-pendulums" id="prldBail" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                </div>
            </form>
        </div>
    </div>
</div>
