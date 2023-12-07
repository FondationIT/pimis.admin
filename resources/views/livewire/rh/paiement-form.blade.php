<div>
    <!-- Modal Affectation -->
    <div class="modal fade" id="paieAModalForms" tabindex="-1" wire:ignore.self role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouvel Paiement</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form  wire:submit.prevent='submit' >
                  <div class="modal-body">

                      

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                            <label>Type de contrat</label>
                            <select class="form-control @error('type') is-invalid @enderror"  wire:model.defer="state.type">
                                <option value=""></option>
                                <option value="CDD">CDD</option>
                                <option value="Consultance">Consultance</option>
                                <option value="Volontariat">Volontariat</option>

                            </select>
                            @error('type')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                          </div>
                      </div>
                      

                      <div class="form-row">
                          <div class="col-md-12 mb-10">
                              <label for="poste">Mois</label>
                              
                              <input type="month" class="form-control @error('month') is-invalid @enderror" wire:model.defer="state.month" name="month">
                              
                              @error('month')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
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
