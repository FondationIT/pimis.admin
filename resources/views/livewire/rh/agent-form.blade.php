<div>


    <!-- Modal Agent -->

    <div class="modal fade" tabindex="-1" id="nAgentModalForms" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvel agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit' >
                <div class="modal-body">

                    <div id="messageErrAgent"></div>

                    <div class="form-row">
                        <div class="col-md-4 mb-10">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="state.name" name="name" placeholder="Nom">
                            @error('name')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="name2">Postnom</label>
                            <input type="text" class="form-control @error('name2') is-invalid @enderror" wire:model.defer="state.name2"  name="name2" placeholder="Postnom">
                            @error('name2')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="name3">Prenom</label>
                            <input type="text" class="form-control" wire:model.defer="state.name3" name="name3" placeholder="Prenon">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="service">Service</label>
                            <select class="form-control @error('service') is-invalid @enderror" wire:model.defer="state.service" name="service" placeholder="Service">
                                <option value=""></option>
                                @foreach ($service as $serv)
                                    <option value="{{$serv->id}}">{{$serv->name}}</option>
                                @endforeach
                            </select>
                            @error('service')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-10">
                            <label for="service">Fonction</label>
                            <select class="form-control @error('fonction') is-invalid @enderror" wire:model.defer="state.fonction" name="fonction" placeholder="fonction">
                                <option value=""></option>
                                <option value="1">Chef de service</option>
                                <option value="2">Senior</option>
                                <option value="3">Autre</option>
                            </select>
                            @error('fonction')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="email">Adresse mail</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-envelop"></i></span>
                                </div>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="state.email" name="email" placeholder="Adresse mail" aria-describedby="inputGroupPrepend">
                            </div>
                            @error('email')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-10">
                            <label for="phone">Numero de telephone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model.defer="state.phone" name="phone" placeholder="Numero de telephone" aria-describedby="inputGroupPrepend">
                            </div>
                            @error('phone')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5 mb-10">
                            <label for="genre">Genre</label>
                            <select class="form-control @error('genre') is-invalid @enderror" wire:model.defer="state.genre" name="genre" placeholder="Genre">
                                <option value=""></option>
                                <option value="Masculin">Masculin</option>
                                <option value="Feminin">Feminin</option>
                                <option value="Autre">Autre</option>
                            </select>
                            @error('genre')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="etatcivil">Etat civil</label>
                            <select class="form-control @error('etatcivil') is-invalid @enderror" wire:model.defer="state.etatcivil" name="etatcivil" placeholder="Etat civil">
                                <option value=""></option>
                                <option value="Marie(e)">Marie(e)</option>
                                <option value="Celibataire">Celibataire</option>
                                <option value="Divorce(e)">Divorce(e)</option>
                                <option value="Veuf(ve)">Veuf(ve)</option>
                            </select>
                            @error('etatcivil')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="etatcivil">Nbre Enfant</label>
                            <input type="number" step="1" min="0" class="form-control @error('enfant') is-invalid @enderror" wire:model.defer="state.enfant" name="enfant">
                               
                            @error('enfant')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="lieuN">Lieu de naissance</label>
                            <input type="text" class="form-control @error('lieuN') is-invalid @enderror" wire:model.defer="state.lieuN" name="lieuN" placeholder="Lieu de naissance">
                            @error('lieuN')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="dateN">Date de naissance</label>
                            <input type="date" class="form-control @error('dateN') is-invalid @enderror" wire:model.defer="state.dateN" name="dateN" placeholder="Date de naissance">
                            @error('dateN')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" wire:model.defer="state.region" name="region" placeholder="Region">
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="pays">Pays</label>
                            <input type="text" class="form-control" wire:model.defer="state.pays" name="pays" placeholder="Pays">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="description">Description</label>
                            <textarea class="form-control" wire:model.defer="state.description" name="description"></textarea>
                        </div>
                    </div>
                    <h5>Personne de contact</h5><hr>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="nom2">Nom complet</label>
                            
                            <input type="text" class="form-control @error('nom2') is-invalid @enderror" wire:model.defer="state.nom2" name="nom2" placeholder="Nom complet">
                            
                            @error('nom2')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-10">
                            <label for="phone2">Numero de telephone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control @error('phone2') is-invalid @enderror" wire:model.defer="state.phone2" name="phone2" placeholder="Numero de telephone" aria-describedby="inputGroupPrepend">
                            </div>
                            @error('phone2')
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
