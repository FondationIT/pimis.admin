<div>
    <!-- Modal Affectation -->
    <div class="modal fade" id="nAffectationModalForms" tabindex="-1" wire:ignore.self role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouvel Affectation</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form  wire:submit.prevent='submit' >
                  <div class="modal-body">

                      

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="agent">Selectionner agent</label>
                              <select class="form-control select2 @error('agent') is-invalid @enderror" wire:model.defer="state.agent" name="agent">
                                  <option value=""></option>

                                  @foreach ($agents as $agent)
                                      <option value="{{$agent->id}}">{{$agent->firstname.' '.$agent->lastname.' '.$agent->middlename}}</option>
                                  @endforeach
                              </select>
                              @error('agent')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="projet">Selectionner projet</label>
                              <select class="form-control select2 @error('projet') is-invalid @enderror" wire:model.defer="state.projet" name="projet">
                                <option value=""></option>

                                @foreach ($projets as $projet)
                                    <option value="{{$projet->id}}">{{$projet->name}}</option>
                                @endforeach
                              </select>
                              @error('projet')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                          </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="cath">Role</label>
                            <select class="form-control select2 @error('cath') is-invalid @enderror" wire:model.defer="state.cath" name="cath">
                              <option value=""></option>
                              <option value="1">Chef Projet</option>
                              <option value="2">Appuis Projet</option>

                            </select>
                            @error('cath')
                              <span class="text-red-600" role="alert">
                                  {{ $message }}
                              </span>
                          @enderror
                        </div>
                     </div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="poste">Intituler du poste</label>
                              <div class="input-group">
                                  <input type="text" class="form-control @error('poste') is-invalid @enderror" wire:model.defer="state.poste" name="poste" placeholder="Poste" aria-describedby="inputGroupPrepend">
                              </div>
                              @error('poste')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="lieu">Lieu d'affectation</label>
                              <div class="input-group">
                                  <input type="text" class="form-control @error('lieu') is-invalid @enderror" wire:model.defer="state.lieu" name="lieu" placeholder="Lieu d'affectation" aria-describedby="inputGroupPrepend">

                              </div>
                              @error('lieu')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                          </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <textarea class="form-control"  wire:model.defer="state.description" name="description"></textarea>
                            </div>
                        </div>
                      </div>


                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-primary" wire:loading.attr='disabled' type="submit">Valider</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
