<div>
    {{-- Success is as dangerous as failure. --}}

     <!-- Modal User -->
    <div class="modal fade" id="nUserModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouvel Utilisateur</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form wire:submit.prevent='submit' >
                <div class="modal-body">

                    <div id="messageErrUs"></div>

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
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="role">Selectionner role</label>
                            <select class="form-control select2 @error('role') is-invalid @enderror" wire:model.defer="state.role" name="role">
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
                            @error('role')
                                <span class="error" >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="email">Nom d'utilisateur</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-user"></i></span>
                                </div>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Nom d'utilisateur" wire:model.defer="state.email" aria-describedby="inputGroupPrepend">

                            </div>
                            @error('email')
                                <span class="text-red-600"role="alert">
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
