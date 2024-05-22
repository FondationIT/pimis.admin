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
                <form id="registerPv" class="needs-validation">
                    <div class="modal-body">
                        <div id="messageErrPv"></div>

                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label for="description">Reference DA</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                <input type="text" id="daPv" class="form-control" value="{{$da[0]->id}}" hidden>
                                @endif

                            </div>
                            <div class="col-md-8 mb-10">
                                <label>Titre PV</label>
                                <input type="text" class="form-control" id="titrePv" required>

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
                                                @foreach ($proforma as $prof)
                                                <th>{{App\Models\Fournisseur::firstWhere('id', $prof->fournisseur)->name}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $prod)
                                                <tr>

                                                    <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}}</td>
                                                    <td>{{$prod->quantite}} {{App\Models\Article::firstWhere('id', $prod->product)->unite}}</td>
                                                    @foreach ($proforma as $prof)
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend">$</span>
                                                            </div>
                                                            <input type="number" id="prixPv" min="0" class="form-control prixPv" required>
                                                            

                                                            <input type="text" id="profPv" class="profPv"  value="{{$prof->id}}" hidden>
                                                            <input type="text" id="prodPv" class="prodPv" value="{{$prod->description}}" hidden>

                                                        </div>
                                                    </td>
                                                    @endforeach

                                                </tr>

                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div><hr>
                        <div class="form-row">

                            <div class="col-md-6 mb-10">
                                <label>Date de cloture</label>
                                <input type="date" class="form-control" id="datePv" required>
                            </div>
                            
                            <input id="allPartPVPlus" value="{{$agents}}" hidden>
                            <div class="col-md-6 mb-10">
                                <label>Observation</label>
                                <textarea type="" class="form-control" id="obsPv" required></textarea>
                            </div>
                        </div><hr>

                        <div class="form-row">
                            <div class="col-md-3 mb-10">

                            </div>

                            <div class="col-md-6 mb-10">
                                <label>Les participants</label>
                                <select class="form-control fournPartPV" id="agPv1" required>
                                    <option value=""></option>
                                    @foreach ($agents as $agent)
                                        <option value="{{$agent->id}}">{{$agent->firstname.' '.$agent->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-10">

                            </div>
                        </div>
                        <div id="autrePartPV">
                        </div>
                        <a href="#" id="partPVAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnPv" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldPv" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
