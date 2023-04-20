<div>
    <!-- Modal Produit -->

    <div class="modal fade" id="nProductModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau produit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                <div class="modal-body">

                    <div id="messageErrProd"></div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="categorie">Selectionner categorie *</label>
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
                            <label for="designation">Designation *</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" wire:model.defer="state.designation" name="designation" placeholder="Designation">
                            @error('designation')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="model">Marque *</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" wire:model.defer="state.marque" name="marque" placeholder="Marque">
                            @error('marque')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="model">Model *</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" wire:model.defer="state.model" name="model" placeholder="Model">
                            @error('model')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="description">Description</label>
                            <textarea class="form-control" wire:model.defer="state.description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="unite">Unité *</label>
                            <input type="text" class="form-control @error('unite') is-invalid @enderror" wire:model.defer="state.unite" name="unite" placeholder="Unité">
                            @error('unite')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
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
