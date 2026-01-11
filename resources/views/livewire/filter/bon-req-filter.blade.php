

<!-- Tab content -->
<div class="tab-content" id="filterTabsContent">
    <!-- Status Tabs -->
    <div class="mb-3 border-b border-gray-200">
        <ul class="nav nav-tabs">
            <li class="nav-item cursor-pointer">
                <a class="nav-link active" data-bs-toggle="tab" wire:click.prevent="$emit('dataStatus',3)">En cours</a>
            </li>
            <li class="nav-item cursor-pointer">
                   <a class="nav-link" data-bs-toggle="tab" wire:click.prevent="$emit('dataStatus',1)">Approuver</a>
            </li>
            <li class="nav-item cursor-pointer">
                <a class="nav-link" data-bs-toggle="tab" wire:click.prevent="$emit('dataStatus',2)">Refuser</a>
            </li>
        </ul>
    </div>

  <!-- Tab 1: Filtres -->
  <div class="tab-pane fade show active" id="filterTab" role="tabpanel" aria-labelledby="filter-tab">
      <div>
          <form wire:submit.prevent='filterEb' wire:reset.prevent=''>
              <div class="form-row">
                  <div hidden>{{$modelId}}</div>
                  <div class="col-md-9 mb-10">
                      <div class="row">
                          <div class="col-md-3 mb-10">
                              <input class="form-control @error('debut') is-invalid @enderror" wire:model.defer="state.debut" type="date">
                              @error('debut')
                                  <span class="text-red-600" role="alert">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-3 mb-10">
                              <input class="form-control @error('fin') is-invalid @enderror" wire:model.defer="state.fin" type="date">
                              @error('fin')
                                  <span class="text-red-600" role="alert">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-3 mb-10">
                              <select class="form-control @error('projet') is-invalid @enderror" wire:model.defer="state.projet">
                                  <option value="">Projet</option>
                                  <option value="0">Tous</option>
                                  @if (Auth::user()->role == 'C.P' || Auth::user()->role == 'COMPT2')
                                      @foreach ($affectation as $aff)
                                          <option value="{{$aff->projet}}">{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</option>
                                      @endforeach
                                  @else
                                      @foreach ($projet as $aff)
                                          <option value="{{$aff->id}}">{{$aff->name}}</option>
                                      @endforeach
                                  @endif
                              </select>
                              @error('projet')
                                  <span class="text-red-600" role="alert">{{ $message }}</span>
                              @enderror
                          </div>
                          {{-- <div class="col-md-2 mb-10">
                              <select class="form-control @error('status') is-invalid @enderror" wire:model.defer="state.status">
                                  <option value="">Status</option>
                                  <option value="0">Tous</option>
                                  <option value="1">Approuver</option>
                                  <option value="2">En cours</option>
                                  <option value="3">Refuser</option>
                              </select>
                              @error('status')
                                  <span class="text-red-600" role="alert">{{ $message }}</span>
                              @enderror
                          </div> --}}
                      </div>
                  </div>

                  <div class="col-md-1 mb-10">
                      <button class="btn btn-primary" wire:loading.attr='disabled' type="submit">Filter</button>
                  </div>

                  <div class="col-md-1 mb-10">
                      <button class="btn btn-secondary" type="reset" wire:loading.attr='disabled' wire:click='resetForm'>Réinitialiser</button>
                  </div>
              </div>
          </form>
      </div>
  </div>

  <!-- Tab 2: Paramètres -->
  {{-- <div class="tab-pane fade" id="settingsTab" role="tabpanel" aria-labelledby="settings-tab">
      <div class="p-3">
          <h6>Paramètres additionnels</h6>
          <p>Vous pouvez ajouter ici des options avancées ou des configurations futures.</p>
          <input type="text" class="form-control mb-3" placeholder="Exemple de champ">
          <button class="btn btn-success">Sauvegarder</button>
      </div>
  </div> --}}

</div>
