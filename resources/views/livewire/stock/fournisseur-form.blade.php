<div>
    <div class="modal fade" id="nFournisseurModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fournisseur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="name">Nom *</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" wire:model.defer="state.name" name="name">
                                @error('name')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="email">Adresse mail *</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" wire:model.defer="state.email" name="email">
                                @error('email')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-10">
                                <label for="phone">Telephone *</label>
                                <input type="text" class="form-control  @error('phone') is-invalid @enderror" wire:model.defer="state.phone" name="phone">
                                @error('phone')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="adress">Adresse phisique *</label>
                                <input type="text" class="form-control  @error('adress') is-invalid @enderror" wire:model.defer="state.adress" name="adress">
                                @error('adress')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="secteur">Secteur d'activite *</label>
                                <select class="form-control select2 @error('secteur') is-invalid @enderror" wire:model.defer="state.secteur" name="secteur">
                                    <option value="">Selectioner un secteur d'activite</option>
                                    <option value="Fournisseurs commerciaux">Fournisseurs commerciaux</option>
                                    <option value="OSC nationales">OSC nationales</option>
                                    <option value="Organismes gouvernementaux nationaux">Organismes gouvernementaux nationaux</option>
                                    <option value="OSC internationales">OSC internationales</option>
                                    <option value="Organisations internationales">Organisations internationales</option>
                                    <option value="Consultant individuel/non-membre du personnel">Consultant individuel/non-membre du personnel</option>
                                    <option value="Autre">Autre</option>
                                </select>
                                @error('secteur')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-10">
                                <label for="type">Type de business *</label>
                                <select class="form-control select2 @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                    <option value="">Selectioner un type de business</option>
                                    <option value="Production/fabrication directe">Production/fabrication directe</option>
                                    <option value="Revete/distribution/fourniture de services">Revete/distribution/fourniture de services</option>
                                    <option value="Autre">Autre</option>
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
                                <label for="categorie">Categorie de produit *</label>
                                <select class="form-control select2 @error('categorie') is-invalid @enderror" wire:model.defer="state.categorie" name="categorie">
                                    <option value=""></option>
                                    @foreach ($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @error('categorie')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Autre detail</label>
                                <textarea class="form-control" wire:model.defer="state.description" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" wire:loading.attr='disabled' id="btnCat" type="submit">Valider</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
