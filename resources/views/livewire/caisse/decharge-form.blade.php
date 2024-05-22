<div>


    <!-- Modal Agent -->

    <div class="modal fade" tabindex="-1" id="dechargeModalForms" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle Decharge</h5>
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
                        <div class="col-md-3 mb-10">
                            <label for="adresse">Montant originel</label>
                            <input type="text" class="form-control" wire:model.defer="state.montantBp" readonly>
                        </div>
                        <div class="col-md-3 mb-10">
                            <label for="adresse">Montant restant</label>
                            <input type="text" class="form-control" wire:model.defer="state.soldeBp" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="int">Beneficiaire</label>
                            <input type="text" class="form-control @error('ben') is-invalid @enderror " wire:model.defer="state.ben" >
                            @error('ben')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-10">
                            <label for="qualite">Qualité</label>
                            <input type="text" class="form-control @error('qualite') is-invalid @enderror " wire:model.defer="state.qualite">
                            @error('qualite')
                            <span class="text-red-600" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="pid">N<sup>o</sup> Piece d'identité</label>
                            <input type="text" class="form-control @error('pid') is-invalid @enderror " wire:model.defer="state.pid" >
                            @error('pid')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-10">
                            <label for="phone">N<sup>o</sup> Telephone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror " wire:model.defer="state.phone">
                        </div>
                        @error('phone')
                            <span class="text-red-600" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="col-md-3 mb-10">
                            <label for="int">Montant en chifre</label>
                            <input type="number" min="1" max="{{$solde}}" class="form-control @error('montant') is-invalid @enderror" wire:model.defer="state.montant" name="montant" required >
                            @error('montant')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-9 mb-10">
                            <label for="montantTL">Montant en Lettre</label>
                            <input type="texte" class="form-control @error('montantTL') is-invalid @enderror" wire:model.defer="state.montantTL" name="montantTL" >
                            @error('montantTL')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="inst">Institution</label>
                            <input type="text" class="form-control @error('inst') is-invalid @enderror" wire:model.defer="state.inst" name="inst" >
                            @error('inst')
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
