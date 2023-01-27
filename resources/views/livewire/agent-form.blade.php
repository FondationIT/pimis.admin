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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="state.name" name="name" placeholder="Nom">
                            @error('name')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="name2">Postnom</label>
                            <input type="text" class="form-control @error('name2') is-invalid @enderror" wire:model="state.name2"  name="name2" placeholder="Postnom">
                            @error('name2')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="name3">Prenom</label>
                            <input type="text" class="form-control" wire:model="state.name3" name="name3" placeholder="Prenon">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="service">Service</label>
                            <select class="form-control @error('service') is-invalid @enderror" wire:model="state.service" name="service" placeholder="Service">
                                <option value=""></option>
                                <option value="Administration">Administration</option>
                                <option value="Programme">Programme</option>
                                <option value="Resources humaines">Resources humaines</option>
                                <option value="Finance">Finance</option>
                                <option value="Logistiaue">Logistiaue</option>
                                <option value="IT">IT</option>
                                <option value="Audit interne">Audit interne</option>
                            </select>
                            @error('service')
                                <span class="error">
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
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                </div>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="state.email" name="email" placeholder="Adresse mail" aria-describedby="inputGroupPrepend">
                            </div>
                            @error('email')
                                <span class="error">
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
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="state.phone" name="phone" placeholder="Numero de telephone" aria-describedby="inputGroupPrepend">
                            </div>
                            @error('phone')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="genre">Genre</label>
                            <select class="form-control @error('genre') is-invalid @enderror" wire:model="state.genre" name="genre" placeholder="Genre">
                                <option value=""></option>
                                <option value="Masculin">Masculin</option>
                                <option value="Feminin">Feminin</option>
                                <option value="Autre">Autre</option>
                            </select>
                            @error('genre')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="etatcivil">Etat civil</label>
                            <select class="form-control @error('etatcivil') is-invalid @enderror" wire:model="state.etatcivil" name="etatcivil" placeholder="Etat civil">
                                <option value=""></option>
                                <option value="Marie(e)">Marie(e)</option>
                                <option value="Celibataire">Celibataire</option>
                                <option value="Divorce(e)">Divorce(e)</option>
                            </select>
                            @error('etatcivil')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="lieuN">Lieu de naissance</label>
                            <input type="text" class="form-control @error('lieuN') is-invalid @enderror" wire:model="state.lieuN" name="lieuN" placeholder="Lieu de naissance">
                            @error('lieuN')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="dateN">Date de naissance</label>
                            <input type="date" class="form-control @error('dateN') is-invalid @enderror" wire:model="state.dateN" name="dateN" placeholder="Date de naissance">
                            @error('dateN')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" wire:model="state.adresse" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" wire:model="state.region" name="region" placeholder="Region">
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="pays">Pays</label>
                            <input type="text" class="form-control" wire:model="state.pays" name="pays" placeholder="Pays">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="description">Description</label>
                            <textarea class="form-control" wire:model="state.description" name="description"></textarea>
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
