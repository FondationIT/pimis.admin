<div>
    <div class="modal fade" id="bcModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de commande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Reference</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                @endif

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="fin">Personne de contact</label>
                                <input type="text" class="form-control @error('pers') is-invalid @enderror" wire:model.defer="state.pers" name="pers">
                                @error('pers')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="fin">Lieu de livraison</label>
                                <input type="text" class="form-control @error('lieu') is-invalid @enderror" wire:model.defer="state.lieu" name="lieu">
                                @error('lieu')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="fin">Delai de livraison</label>
                                <input type="text" class="form-control @error('delai') is-invalid @enderror" wire:model.defer="state.delai" name="delai">
                                @error('delai')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Commentaire</label>
                                <textarea class="form-control" wire:model.defer="state.comment" name="comment"></textarea>
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
