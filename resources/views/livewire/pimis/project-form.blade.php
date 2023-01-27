 <!-- Modal Project -->
 <div class="modal fade" id="nProjectModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Nouveau projet</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form wire:submit.prevent='submit'>

                <div class="modal-body">

                    <div id="messageErrPojet"></div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="name">Nom du projet *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="state.name" name="name" placeholder="Nom du projet">
                            @error('name')
                                <span class="error" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="dateD">Date Debut *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control @error('dateD') is-invalid @enderror" wire:model.defer="state.dateD" name="dateD" placeholder="Date debut" aria-describedby="inputGroupPrepend">
                                @error('dateD')
                                    <span class="error" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="dateF">Date Fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-calender"></i></span>
                                </div>
                                <input type="date" class="form-control" wire:model.defer="state.dateF" name="dateF" placeholder="Date fin" aria-describedby="inputGroupPrepend">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="bailleur">Bailleur *</label>
                            <select class="form-control @error('bailleur') is-invalid @enderror" wire:model.defer="state.bailleur" name="bailleur" placeholder="">
                                <option value=""></option>

                                @foreach ($bailleurs as $bailleur)
                                    <option value="{{$bailleur->id}}">{{$bailleur->name}}</option>
                                @endforeach
                            </select>
                            @error('bailleur')
                                <span class="error" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="contexte">Contexte</label>
                            <div class="tinymce-wrap">
                                <textarea class="tinymce" wire:model="state.contexte" name="contexte"  ></textarea>
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

