<div>
    <!-- Modal Produit -->

    <div class="modal fade" id="ligneArtModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ligne budgetaire</h5>
                    <button type="button" class="close closeLigne" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="apprEtBes" class="needs-validation" >
                    <div class="modal-body">

                        <div id="messageErrLigne"></div>

                        <input type="text"  id="allLigne" hidden value='{"bad":{{json_encode($lignes)}} }' >
                        @if ($eb)
                        <input type="text"  id="idEbLigne" hidden value="{{$eb[0]->id}}" >
                        <input type="text"  id="typeLigne" hidden value="{{$type}}" >
                        @endif
                        
                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="">Selectionner rubrique*</label>
                                <select class="form-control select2" onchange="afficheAppChoix(this.value)" id="line1" required >
                                    <option value=""></option>
                                        @foreach ($ribrique as $four)
                                            <option value="{{$four->code}}">{{$four->libele}} {{$four->code}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row" wire:ignore>
                            <div class="col-md-12 mb-10">
                                <label for="categorie">Selectionner categorie *</label>
                                <select class="form-control select2" onchange="afficheApp1Choix(this.value)" id="line2" required>
                                </select>
                            </div>
                        </div>

                        <div class="form-row" wire:ignore>
                            <div class="col-md-12 mb-10">
                                <label for="categorie">Selectionner activité *</label>
                                <select class="form-control select2" onchange="afficheApp2Choix(this.value)" id="line3" required>
                                </select>
                            </div>
                        </div>

                        <div class="form-row" wire:ignore>
                            <div class="col-md-12 mb-10">
                                <label for="categorie">Selectionner ligne *</label>
                                <select class="form-control select2" id="line4" required>
                                </select>
                            </div>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnAppEtBes" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldAppEtBes" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

