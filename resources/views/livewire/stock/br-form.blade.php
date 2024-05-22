<div>
    <div class="modal fade" id="brModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de reception</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="registerBr" class="needs-validation">
                    <div class="modal-body">
                        <div id="messageErrBr"></div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="description">Bon de Commande</label>
                                @if ($bc)
                                <input type="text" class="form-control" value="{{$bc[0]->reference}}" readonly>
                                <input type="text" class="form-control" id="bcBr" value="{{$bc[0]->id}}" hidden>
                                @endif
                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="description">Demande d'achat</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="fin">Projet</label>
                                @if ($projet)
                                <input type="text" class="form-control" value="{{$projet[0]->name}}" readonly>
                                <input type="text" class="form-control" id="projetBr" value="{{$projet[0]->id}}" hidden>
                                @endif
                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="fin">Fournisseur</label>
                                @if ($fournisseur)
                                <input type="text" class="form-control" value="{{$fournisseur[0]->name}}" readonly>
                                <input type="text" class="form-control" id="fournisseurBr" value="{{$fournisseur[0]->id}}" hidden>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="fin">Personne/Fournisseur</label>
                                <input type="text" class="form-control" id="personneBr" name="personne" required>
                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="fin">Lieu de reception</label>
                                <input type="text" class="form-control" id="lieuBr" name="lieu" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="fin">Bordereau de livraison</label>
                                <input type="text" class="form-control" id="bordereauBr" name="Bordereau" required>
                            </div>

                            <div class="col-md-6 mb-10">
                                <label for="fin">Etat de reception</label>
                                <input type="text" class="form-control" id="etatBr" name="etat" required>
                            </div>
                        </div>



                        <hr>
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Unite</th>
                                                <th>Qte à livrer</th>
                                                <th>Qte recue</th>
                                                <th>Observation</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $prod)
                                                <tr>

                                                    <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}} {{App\Models\Article::firstWhere('id', $prod->description)->description}}</td>
                                                    <td>{{App\Models\Article::firstWhere('id', $prod->description)->unite}}</td>

                                                    @if ($prod->quantite == App\Models\BrOder::where('bc', $bc[0]->id)->where('produit', $prod->description)->get('quantite')->sum('quantite'))

                                                        <td><x-icons.check-circle class="text-green-600 mx-auto" /></td>
                                                        <td><x-icons.check-circle class="text-green-600 mx-auto" /></td>
                                                        <td>Tout est déjà receptionné</td>
                                                            
                                                    @else
                                                            
                                                        

                                                        <td>{{$prod->quantite - App\Models\BrOder::where('bc', $bc[0]->id)->where('produit', $prod->description)->get('quantite')->sum('quantite')}}</td>
                                                        <td>
                                                            
                                                                <input type="number" style="width: 100px" id="prixBr" step=1 min=0 max={{$prod->quantite - App\Models\BrOder::where('bc', $bc[0]->id)->where('produit', $prod->description)->get('quantite')->sum('quantite')}} class="form-control qteBr" required>
                                                            
                                                        </td>
                                                        <td>
                                                            
                                                            <textarea class="form-control observationBr" style="width: 200px"  name="comment" required></textarea>
                                                            
                                                        </td>
                                                        <input type="text" id="prodBr" class="prodBr" value="{{$prod->description}}" hidden>
                                                    @endif
                                                    
                                                    

                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <hr>



                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="description">Commentaire</label>
                                <textarea class="form-control" id="commentBr" name="comment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnBr" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldBr" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
