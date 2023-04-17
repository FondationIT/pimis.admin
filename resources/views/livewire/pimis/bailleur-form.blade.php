<div>
<!-- Modal Bailleurs -->
<div class="modal fade" id="nBailleursModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Nouveau bailleur</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form  wire:submit.prevent='submit' >

                <div class="modal-body">

                    <div id="messageErrBailleur"></div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="name">Nom du bailleur *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="state.name" name="name" placeholder="Nom du bailleur" >
                            @error('name')
                                <span class="text-red-600" role="alert" >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="email">Adresse mail *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="state.email" name="email" placeholder="Adresse mail" >
                            @error('email')
                                <span class="text-red-600" role="alert" >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="phone">Numero de telephone *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model.defer="state.phone" name="phone" placeholder="Numero de telephone" >
                            @error('phone')
                                <span class="text-red-600" role="alert" >
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="Adresse">
                        </div>
                    </div>
<!--
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="adresse">Achat directe</label>
                            <div class="form-row">
                                <div class="col-md-6 mb-10">

                                De <input type="number" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="$">
                                </div>
                                <div class="col-md-6 mb-10">
                                A <input type="number" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="$">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="adresse">Achat par la comparaison </label>
                            <div class="form-row">
                                <div class="col-md-6 mb-10">

                                   De <input type="number" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="$">
                                </div>
                                <div class="col-md-6 mb-10">
                                   A <input type="number" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="$">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="adresse">Appel d’Offres </label>

                            <div class="form-row">
                                <div class="col-md-6 mb-10">
                                   De <input type="number" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="$">
                                </div>
                                <div class="col-md-6 mb-10">
                                   A <input type="number" class="form-control" wire:model.defer="state.adresse" name="adresse" placeholder="$">
                                </div>
                            </div>
                        </div>
                    </div>
                -->

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" wire:loading.attr='disabled' type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
