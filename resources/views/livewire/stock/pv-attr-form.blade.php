<div>
    <div class="modal fade" id="pvAttrModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PV D'ATTRIBUTION DE MARCHER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="registerPvAttr" class="needs-validation">
                    <div class="modal-body">
                        <div id="messageErrPv2"></div>

                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label for="description">Reference Pv d'analyse</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                <input type="text" id="daPv2" class="form-control" value="{{$da[0]->id}}" hidden>
                                @endif

                            </div>
                            <div class="col-md-8 mb-10">
                                <label>Titre PV</label>
                                <input type="text" class="form-control" id="titrePv2" required>

                            </div>
                        </div>
                        <hr>
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qte</th>
                                                <th>Fournisseur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $prod)
                                                <tr>

                                                    <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}}</td>
                                                    <td>{{$prod->quantite}} {{App\Models\Article::firstWhere('id', $prod->product)->unite}}</td>
                                                    <input type="text" id="prodPv2" class="prodPv2" value="{{$prod->description}}" hidden>
                                                    <td>
                                                        <select class="form-control fournPv2" id="fournPv2" required>
                                                            <option value=""></option>
                                                            @foreach ($proforma as $prof)
                                                                <option value="{{$prof->id}}">{{App\Models\Fournisseur::firstWhere('id', $prof->fournisseur)->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                   

                                                </tr>

                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div><hr>
                        <div class="form-row">
                            <input id="allPartPVPlus2" value="{{$agents}}" hidden>
                            <div class="col-md-6 mb-10">
                                <label>Observation</label>
                                <textarea type="" class="form-control" id="obsPv2" required></textarea>
                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Justificatiom</label>
                                <textarea type="" class="form-control" id="justPv2" required></textarea>
                            </div>
                        </div><hr>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">

                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Les participants</label>
                                <select class="form-control fournPartPV2" id="agPv21" required>
                                    <option value=""></option>
                                    @foreach ($agents as $agent)
                                        <option value="{{$agent->id}}">{{$agent->firstname.' '.$agent->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-10">

                            </div>
                        </div>
                        <div id="autrePartPV2">
                        </div>
                        <a href="#" id="partPVAdd2" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnPv2" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldPv2" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
