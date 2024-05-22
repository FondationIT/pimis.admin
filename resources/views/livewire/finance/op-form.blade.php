<div>


    <!-- Modal Agent -->

    <div class="modal fade" tabindex="-1" id="opModalForms" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvel ordre de paiement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit' >
                <div class="modal-body">

                    <div id="messageErrCompte"></div>

                    @if($bps)
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="int">Donneur</label>
                            <input type="text" class="form-control" wire:model.defer="state.don" readonly>
                            
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="num">Compte donneur</label>
                            <input type="texte" class="form-control" wire:model.defer="state.cDon"   readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="int">Beneficiaire</label>
                            <input type="text" class="form-control" wire:model.defer="state.ben" readonly >
                        </div>
                        <div class="col-md-6 mb-10">
                            <label for="num">Compte Beneficiaire</label>
                            <input type="texte" class="form-control" wire:model.defer="state.cBen" readonly >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="banque">Banque</label>
                            <input type="text" class="form-control" wire:model.defer="state.banque" readonly>
                          
                        </div>
                        
                        <div class="col-md-6 mb-10">
                            <label for="adresse">Montant</label>
                            <input type="text" class="form-control" wire:model.defer="state.montant" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-10">
                            <label for="int">Lieu d'emission</label>
                            <input type="text" class="form-control @error('lieu') is-invalid @enderror" wire:model.defer="state.lieu" name="lieu" >
                            @error('lieu')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-8 mb-10">
                            <label for="num">Numero d'ordre de paiement</label>
                            <input type="texte" class="form-control @error('num') is-invalid @enderror" wire:model.defer="state.num" name="num" >
                            @error('num')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="motif">Motif</label>
                            <textarea type="text" class="form-control @error('motif') is-invalid @enderror" wire:model.defer="state.motif" name="motif" ></textarea>
                            @error('motif')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" wire:loading.attr='disabled'  type="submit">Valider</button>
                </div>
            </form>
            </div>

        </div>
    </div>


</div>