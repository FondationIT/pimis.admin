<div>
    <div class="modal fade" id="proformaModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($bailleur)

                        @if ($bailleur[0]->min1 <= $some && $some <= $bailleur[0]->max1)

                            <h5 class="modal-title">Proforma pour un achat direct</h5>

                        @elseif ($bailleur[0]->min2 <= $some && $some <= $bailleur[0]->max2)

                            <h5 class="modal-title">Proforma pour un achat par comparaison</h5>

                        @elseif ($bailleur[0]->min3 <= $some && $some <= $bailleur[0]->max3)

                            <h5 class="modal-title">Dossier de soumission</h5>

                        @else

                            <h5 class="modal-title">Proforma99 {{$bailleur[0]->name}}</h5>

                        @endif
                    @endif

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="registerProforma" class="needs-validation">
                    <div class="modal-body">
                        <div id="messageErrProforma"></div>

                        <div class="form-row">
                            <div class="col-md-8 mb-10">
                                <label for="description">Reference DA</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                <input type="text" id="daProf" class="form-control" value="{{$da[0]->id}}" hidden>
                                @endif

                            </div>
                            <div class="col-md-4 mb-10">
                                <label for="description">Montant DA</label>
                                @if ($some)
                                <input type="text" class="form-control" style="text-align: center" value="$ {{$some}}" readonly>
                                @endif

                            </div>
                        </div>
                        <hr>

                        <div class="form-row">

                            <div class="col-md-1 mb-10">

                            </div>

                            <div class="col-md-5 mb-10">
                                <label for="fournisseur">Fournisseur</label>

                                <select class="form-control fournProf" id="fournP1" name="fournisseur" required>
                                    <option value=""></option>
                                    @foreach ($fournisseurs as $four)
                                        <option value="{{$four->id}}">{{$four->name}}</option>
                                    @endforeach
                                </select>

                                <div class="invalid-feedback">
                                    Selectionner un fournisseur
                                </div>
                            </div>
                            <div class="col-md-5 mb-10">
                                @if ($bailleur)
                                    @if ($bailleur[0]->min3 <= $some && $some <= $bailleur[0]->max3)
                                    <label for="reference">Reference dossier</label>
                                    @else
                                    <label for="reference">Reference proforma</label>
                                    @endif
                                @endif
                                <input type="text" class="form-control refProf" name="reference"  aria-describedby="inputGroupPrepend" required>

                                <div class="invalid-feedback">
                                    La reference proforma est obligatoire
                                </div>
                            </div>



                            <div class="col-md-1 mb-10">

                            </div>
                        </div>
                        @if ($bailleur)
                            @if ($bailleur[0]->min2 <= $some)

                            <div class="form-row">

                                <div class="col-md-1 mb-10">

                                </div>

                                <div class="col-md-5 mb-10">
                                    <label for="fournisseur">Fournisseur</label>

                                    <select class="form-control fournProf"  name="fournisseur" required>
                                        <option value=""></option>
                                        @foreach ($fournisseurs as $four)
                                            <option value="{{$four->id}}">{{$four->name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                        Selectionner un fournisseur
                                    </div>
                                </div>
                                <div class="col-md-5 mb-10">
                                    @if ($bailleur)
                                        @if ($bailleur[0]->min3 <= $some && $some <= $bailleur[0]->max3)
                                        <label for="reference">Reference dossier</label>
                                        @else
                                        <label for="reference">Reference proforma</label>
                                        @endif
                                    @endif
                                    <input type="text" class="form-control refProf" name="reference"  aria-describedby="inputGroupPrepend" required>

                                    <div class="invalid-feedback">
                                        La reference proforma est obligatoire
                                    </div>
                                </div>



                                <div class="col-md-1 mb-10">

                                </div>
                            </div>
                            <div class="form-row">

                                <div class="col-md-1 mb-10">

                                </div>

                                <div class="col-md-5 mb-10">
                                    <label for="fournisseur">Fournisseur</label>

                                    <select class="form-control fournProf" id="fournP1" name="fournisseur" required>
                                        <option value=""></option>
                                        @foreach ($fournisseurs as $four)
                                            <option value="{{$four->id}}">{{$four->name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                        Selectionner un fournisseur
                                    </div>
                                </div>
                                <div class="col-md-5 mb-10">
                                    @if ($bailleur)
                                        @if ($bailleur[0]->min3 <= $some && $some <= $bailleur[0]->max3)
                                        <label for="reference">Reference dossier</label>
                                        @else
                                        <label for="reference">Reference proforma</label>
                                        @endif
                                    @endif
                                    <input type="text" class="form-control refProf" name="reference"  aria-describedby="inputGroupPrepend" required>

                                    <div class="invalid-feedback">
                                        La reference proforma est obligatoire
                                    </div>
                                </div>



                                <div class="col-md-1 mb-10">

                                </div>
                            </div>

                            @endif
                        @endif


                        <div id="autreProf">
                        </div>
                        @if ($bailleur)

                            <a href="#" id="profAdd" style="float: right;" @if ($bailleur[0]->min1 <= $some && $some <= $bailleur[0]->max1) hidden @endif><i class="icon-plus txt-danger"></i></a>

                        @endif

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnProforma" type="submit">Valider</button>
                    <div class="loader-pendulums" id="prldProforma" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="{{  asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{  asset('js/pages/agent.js')}}"></script>

</div>

