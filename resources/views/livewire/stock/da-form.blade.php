<div>
    <div class="modal fade" id="daModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Demmande d'achat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-3 mb-10">
                                <label for="description">Reference</label>
                                @if ($eb)
                                <input type="text" class="form-control" value="{{$eb[0]->reference}}" readonly>
                                @endif

                            </div>
                            <div class="col-md-6 mb-10">
                                <label for="description">Projet</label>
                                @if ($eb)
                                <input type="text" class="form-control" name="name"value="{{App\Models\Projet::firstWhere('id', $eb[0]->projet)->name}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-3 mb-10">
                                <label for="description">Montant Total</label>
                                <input type="text" class="form-control" name="name" value="${{$somme}}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Motif</label>
                                <input type="text" class="form-control @error('motif') is-invalid @enderror" wire:model.defer="state.motif" name="motif" placeholder="Motif">
                                @error('motif')
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
