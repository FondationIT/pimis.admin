<div>

    <!-- BON DE PAYEMENT CAT1 ACHAT PAR COMPARAISON -->
    <div class="modal fade" id="bpModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de Payement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Reference bon de commande</label>
                                @if ($bcs)
                                <input type="text" class="form-control" value="{{$bcs[0]->reference}}" readonly>
                                @endif

                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="">Projet</label>
                                @if ($bcs)
                                <input type="text" class="form-control" value="{{ App\Models\Projet::where('id', $ebs[0]->projet)->get()[0]->name}}" readonly>
                                @endif

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">
                                <label for="">Montant</label>
                                @if ($bcs)
                                <input type="text" class="form-control"  value="$ {{$some}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-9 mb-10">
                                <label>Montant en toute lettre</label>
                                <input type="text" class="form-control @error('montantTL') is-invalid @enderror" wire:model.defer="state.montantTL" name="montantTL">
                                @error('montantTL')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Fournisseur</label>
                                @if ($bcs)
                                <input type="text" class="form-control"  value="{{ App\Models\Fournisseur::where('id', $fournisseur)->get()[0]->name}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-6 mb-10">
                                <label>Type de payement</label>
                                <select class="form-control @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                    <option value=""></option>
                                    <option value="1">Caisse</option>
                                    <option value="2">Chèque</option>
                                    <option value="3">Transfert bancaire</option>
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
                                <label for="fin">Date de payement</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model.defer="state.date" name="date">
                                @error('date')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Description generale</label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" wire:model.defer="state.comment" name="comment"></textarea>
                                @error('comment')
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









    <!-- BON DE PAYEMENT CAT4 TERME DE REFERENCE -->


    <div class="modal fade" id="bp3ModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de Payement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Reference TDR</label>
                                @if ($trs)
                                <input type="text" class="form-control" value="{{$trs[0]->reference}}" readonly>
                                @endif

                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="">Projet</label>
                                @if ($trs)
                                <input type="text" class="form-control" value="{{ App\Models\Projet::where('id', $trs[0]->projet)->get()[0]->name}}" readonly>
                                @endif

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">
                                <label for="">Montant</label>
                                @if ($trs)
                                <input type="text" class="form-control"  value="$ {{$some}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-9 mb-10">
                                <label>Montant en toute lettre</label>
                                <input type="text" class="form-control @error('montantTL') is-invalid @enderror" wire:model.defer="state.montantTL" name="montantTL">
                                @error('montantTL')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Beneficaire</label>
                                @if ($trs)
                                <input type="text" class="form-control"  value="{{App\Models\User::where('id', $beneficiaire)->get()[0]->name}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-6 mb-10">
                                <label>Type de payement</label>
                                <select class="form-control @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                    <option value=""></option>
                                    <option value="1">Caisse</option>
                                    <option value="2">Chèque</option>
                                    <option value="3">Transfert bancaire</option>
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
                                <label for="fin">Date de payement</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model.defer="state.date" name="date">
                                @error('date')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Description generale</label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" wire:model.defer="state.comment" name="comment"></textarea>
                                @error('comment')
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













    <!-- BON DE PAYEMENT CAT4 NOTE DE DEBIT -->


    <div class="modal fade" id="bp4ModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de Payement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Reference note de debit</label>
                                @if ($nds)
                                <input type="text" class="form-control" value="{{$nds[0]->reference}}" readonly>
                                @endif

                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="">Projet</label>
                                @if ($nds)
                                <input type="text" class="form-control" value="{{ App\Models\Projet::where('id', $nds[0]->projet)->get()[0]->name}}" readonly>
                                @endif

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">
                                <label for="">Montant</label>
                                @if ($nds)
                                <input type="text" class="form-control"  value="$ {{$some}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-9 mb-10">
                                <label>Montant en toute lettre</label>
                                <input type="text" class="form-control @error('montantTL') is-invalid @enderror" wire:model.defer="state.montantTL" name="montantTL">
                                @error('montantTL')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Beneficaire</label>
                                @if ($nds)
                                <input type="text" class="form-control"  value="ADMINISTRATION" readonly>
                                @endif
                            </div>
                            <div class="col-md-6 mb-10">
                                <label>Type de payement</label>
                                <select class="form-control @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                    <option value=""></option>
                                    <option value="3">Transfert bancaire</option>
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
                                <label for="fin">Date de payement</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model.defer="state.date" name="date">
                                @error('date')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Description generale</label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" wire:model.defer="state.comment" name="comment"></textarea>
                                @error('comment')
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


    <!-- BON DE PAYEMENT CAT5 APPROVISIONEMENT CAISSE -->


    <div class="modal fade" id="bp5ModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de Payement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Reference note de debit</label>
                                @if ($nds)
                                <input type="text" class="form-control" value="{{$nds[0]->reference}}" readonly>
                                @endif

                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="">Projet</label>
                                @if ($nds)
                                <input type="text" class="form-control" value="{{ App\Models\Projet::where('id', $nds[0]->projet)->get()[0]->name}}" readonly>
                                @endif

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">
                                <label for="">Montant</label>
                                <input type="number" min="1" step="any" class="form-control @error('montant') is-invalid @enderror" wire:model.defer="state.montant" name="montant">
                                @error('montant')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-9 mb-10">
                                <label>Montant en toute lettre</label>
                                <input type="text" class="form-control @error('montantTL') is-invalid @enderror" wire:model.defer="state.montantTL" name="montantTL">
                                @error('montantTL')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="">Beneficaire</label>
                                @if ($nds)
                                <input type="text" class="form-control"  value="Caisse Projet" readonly>
                                @endif
                            </div>
                            <div class="col-md-6 mb-10">
                                <label>Type de payement</label>
                                <select class="form-control @error('type') is-invalid @enderror" wire:model.defer="state.type" name="type">
                                    <option value=""></option>
                                    <option value="2">Chèque</option>
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
                                <label for="fin">Date de payement</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model.defer="state.date" name="date">
                                @error('date')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Description generale</label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" wire:model.defer="state.comment" name="comment"></textarea>
                                @error('comment')
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