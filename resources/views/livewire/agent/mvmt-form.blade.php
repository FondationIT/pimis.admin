<div>
    {{-- Success is as dangerous as failure. --}}

     <!-- Modal Conge -->
    <div class="modal fade" id="mvntModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Mouvement personel</h6>
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
                            <label for="agent">Destination</label>
                            <input class="form-control" wire:model.defer="state.destination" name="destination" >
                            @error('destination')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="dateD">Depart *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="time" class="form-control @error('dateD') is-invalid @enderror" wire:model.defer="state.dateD" name="dateD" placeholder="Date debut" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dateD')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="dateF">Retour *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="time" class="form-control @error('dateF') is-invalid @enderror" wire:model.defer="state.dateF" name="dateF" placeholder="Date fin" aria-describedby="inputGroupPrepend">
                                
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
                            <label for="contexte">Motif</label>
                            <div class="tinymce-wrap">
                                <textarea class="form-control @error('motif') is-invalid @enderror" wire:model.defer="state.motif" name="contexte"  ></textarea>
                            </div>
                            @error('motif')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
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














    <div class="modal fade" id="mvnt2ModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Mouvement agents</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form wire:submit.prevent='submit' >
                <div class="modal-body">


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
                            <label for="agent">Destination</label>
                            <input class="form-control" wire:model.defer="state.destination" name="destination" >
                            @error('destination')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="dateD">Depart *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="time" class="form-control @error('dateD') is-invalid @enderror" wire:model.defer="state.dateD" name="dateD" placeholder="Date debut" aria-describedby="inputGroupPrepend">
                                
                            </div>
                            @error('dateD')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="dateF">Retour *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="time" class="form-control @error('dateF') is-invalid @enderror" wire:model.defer="state.dateF" name="dateF" placeholder="Date fin" aria-describedby="inputGroupPrepend">
                                
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
                            <label for="contexte">Motif</label>
                            <div class="tinymce-wrap">
                                <textarea class="form-control @error('motif') is-invalid @enderror" wire:model.defer="state.motif" name="contexte"  ></textarea>
                            </div>
                            @error('motif')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
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
