<div>
    <div class="modal fade" id="pvModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-3 mb-10">
                                <label for="description">Reference</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                @endif

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
