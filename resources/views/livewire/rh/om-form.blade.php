<div>
    <div class="modal fade" id="omModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ordre de mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="registerMs" class="needs-validation">
                    <div class="modal-body">
                        <div id="messageErrMs"></div>

                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label for="description">Reference TDR</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                <input type="text" id="trMs" class="form-control" value="{{$da[0]->id}}" hidden>
                                @endif

                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label>Type</label>
                                <select class="form-control" id="typeMs" required>
                                    <option value=""></option>
                                    <option value="1">Collectif</option>
                                    <option value="2">Individuel</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Destination</label>
                                <input type="text" class="form-control" id="destMs" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label>Date debut</label>
                                <input type="date" class="form-control" id="dateDMs" required>
                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Date fin</label>
                                <input type="date" class="form-control" id="dateFMs" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label>Duree</label>
                                <input type="text" class="form-control" id="dureMs" required>
                            </div>
                            <div class="col-md-8 mb-10">
                                <input id="allPartMSPlus" value="{{$agents}}" hidden>
                                <label>Objectif</label>
                                <textarea type="" class="form-control" id="objectifMs" required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label>Moyen de transport</label>
                                <select class="form-control" id="moyenMs" required>
                                    <option value=""></option>
                                    
                                    <option value="1">Véhicule</option>
                                    <option value="1">Bateau</option>
                                    <option value="1">Avion</option>
                                    <option value="1">Moto</option>
                                    <option value="1">véhicule Bateau</option>
                                    <option value="1">véhicule Avion</option>
                                    <option value="1">véhicule Bateau Avion</option>
                                    <option value="1">véhicule Bateau Moto</option>
                                    <option value="1">véhicule Avion Moto</option>
                                    <option value="1">Avion Moto</option>
                                    <option value="1">véhicule Moto</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Itineraire</label>
                                <input type="text" class="form-control" id="itMs" required>
                            </div>
                        </div><hr>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">

                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Les participants</label>
                                <select class="form-control fournPartMs" id="agMS1" required>
                                    <option value=""></option>
                                    @foreach ($agents as $agent)
                                        <option value="{{$agent->id}}">{{$agent->firstname.' '.$agent->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-10">

                            </div>
                        </div>
                        <div id="autrePartMS">
                        </div>
                        <a href="#" id="partMSAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnMs" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldMs" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
