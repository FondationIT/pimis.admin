
<livewire:rh-page />

<!-- Modal Agent -->
<livewire:agent-form />



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

