<div>
    {{-- Success is as dangerous as failure. --}}

     <!-- Modal Conge -->
    <div class="modal fade" id="congeModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouveau conge</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form wire:submit.prevent='submit' >
                <div class="modal-body">

                    

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="agent">Agent</label>
                            <input class="form-control" value="{{ Auth::user()->name }}" readonly>
                            <input class="form-control" wire:model.defer="state.agent" name="agent" hidden>
                            @error('agent')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="type">Type</label>
                            <select class="form-control select2 @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                <option value=""></option>
                                <option value="1">Annuel</option>
                                <option value="2">Deces 1er degre</option>
                                <option value="3">Deces 2er degre</option>
                                <option value="4">Mariage</option>
                                <option value="5">Maternite/Paternite</option>
                                <option value="6">Recuperation</option>
                                <option value="7">Demenagement</option>
                                <option value="8">Non paye</option>
                            </select>
                            @error('type')
                                <span class="text-red-600" role="alert" >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="dateD">Date Debut *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control @error('dateD') is-invalid @enderror" wire:model.defer="state.dateD" name="dateD" placeholder="Date debut" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dateD')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="dateF">Date Fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control @error('dateF') is-invalid @enderror" wire:model.defer="state.dateF" name="dateF" placeholder="Date fin" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dateF')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="dateF">Duree par jour ouvrable</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">jours</span>
                                </div>
                                <input type="number" class="form-control @error('dure') is-invalid @enderror" wire:model.defer="state.dure" name="dure" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dure')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="contexte">Motif</label>
                            <div class="tinymce-wrap">
                                <textarea class="form-control" wire:model.defer="state.motif" name="contexte"  ></textarea>
                            </div>
                        </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" wire:loading.attr='disabled'  type="submit">Valider</button>
                </div>

            </form>
            </div>
        </div>
    </div>














    <div class="modal fade" id="conge2ModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouveaux conge</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form wire:submit.prevent='submit' >
                <div class="modal-body">

                    <div hidden>{{$modelId}}</div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="agent">Selectionner agent</label>
                            <select class="form-control select2 @error('agent') is-invalid @enderror" name="agent" wire:model.defer="state.agent">
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
                            <label for="type">Type</label>
                            <select class="form-control select2 @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                <option value=""></option>
                                <option value="1">Annuel</option>
                                <option value="2">Deces 1er degre</option>
                                <option value="3">Deces 2er degre</option>
                                <option value="4">Mariage</option>
                                <option value="5">Maternite/Paternite</option>
                                <option value="6">Recuperation</option>
                                <option value="7">Demenagement</option>
                                <option value="8">Non paye</option>
                            </select>
                            @error('type')
                                <span class="text-red-600" role="alert" >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="dateD">Date Debut *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control @error('dateD') is-invalid @enderror" wire:model.defer="state.dateD" name="dateD" placeholder="Date debut" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dateD')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="dateF">Date Fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control @error('dateF') is-invalid @enderror" wire:model.defer="state.dateF" name="dateF" placeholder="Date fin" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dateF')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="dateF">Duree par jour ouvrable</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">jours</span>
                                </div>
                                <input type="number" class="form-control @error('dure') is-invalid @enderror" wire:model.defer="state.dure" name="dure" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dure')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="contexte">Motif</label>
                            <div class="tinymce-wrap">
                                <textarea class="form-control" wire:model.defer="state.motif" name="contexte"  ></textarea>
                            </div>
                        </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" wire:loading.attr='disabled'  type="submit">Valider</button>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

