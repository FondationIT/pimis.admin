<div>


    <!-- Modal Agent -->

    <div class="modal fade" tabindex="-1" id="compteModalForms" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit' >
                <div class="modal-body">

                    <div id="messageErrCompte"></div>


                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="type">Type</label>
                            <select class="form-control @error('type') is-invalid @enderror" wire:model.defer="state.type" wire:change="change($event.target.value)" name="type" >
                                <option value=""></option>
                                @if (Auth::user()->role == 'COMPT1')
                                    <option value="1">Projet</option>
                                @endif
                                @if (Auth::user()->role == 'R.H')
                                    <option value="2">Agent</option>
                                @endif
                                @if (Auth::user()->role == 'LOG1')
                                    <option value="3">Fournisseur</option>
                                @endif
                                <!--<option value="4">Partenaire</option>-->
                            </select>
                            @error('type')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="prop">Proprietaire</label>

                            <select class="form-control select2 @error('prop') is-invalid @enderror" wire:model.defer="state.prop" >
                                <option value=""></option>
                                    @foreach ($users as $user)
                                        @if (Auth::user()->role == 'R.H')
                                            <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                            </select>
                            
                            @error('prop')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="int">Intitulé</label>
                            <input type="text" class="form-control @error('int') is-invalid @enderror" wire:model.defer="state.int" name="int" >
                            @error('int')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="num">Numero</label>
                            <input type="texte" class="form-control @error('num') is-invalid @enderror" wire:model.defer="state.num" name="num" >
                            @error('num')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="banque">Banque</label>
                            <input type="text" class="form-control @error('banque') is-invalid @enderror" wire:model.defer="state.banque" name="adresse">
                            @error('banque')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-10">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" wire:model.defer="state.adresse" name="adresse">
                            @error('adresse')
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

