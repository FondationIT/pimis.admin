<div>

    <div class="modal fade" id="pBcModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de commande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printBc">

                    <div class="row">

                        

                        <div class="col-lg-6 fix" style="">
                            <div>
                                <br>
                                <h3>BON DE COMMANDE</h3>
                                <p class="">N<sup>o</sup> : <b>@if ($bcs)
                                    {{$bcs[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>
                        <div class="col-lg-3 fix" style="text-align: center">
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">


                    <div class="row">
                        @if ($das)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Fournisseur : <strong>{{ App\Models\Fournisseur::firstWhere('id', $prof[0]->fournisseur)->name}}</strong></p>
                                <p>Projet : <strong>{{ App\Models\Projet::firstWhere('id', $ebs[0]->projet)->name}}</strong></p>
                                <p>Personne de contact : <strong>{{$bcs[0]->personne}}</strong></p>
                                <p>Lieu de livraison : <strong>{{$bcs[0]->lieu}}</strong></p>
                                <p>Delai de livraison : <strong>{{$bcs[0]->delai}}</strong></p>
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>DA-Ref : <strong>{{ $das[0]->reference}}</strong></p>
                                <p>Date : <strong>{{$bcs[0]->created_at->format('d/m/Y')}}</strong></p>
                            </div>
                        @endif

                    </div>
                    <hr>



                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 prodT">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>Design</strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>P.U.E</strong></th><th><strong>P.T.E</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)

                                        <tr>

                                            <td>{{$i++}}</td><td>{{App\Models\Article::firstWhere('id', $prod->produit)->marque.' '.App\Models\Article::firstWhere('id', $prod->produit)->model.' '.App\Models\Article::firstWhere('id', $prod->produit)->description}}</td>

                                            <td>{{ App\Models\ProductOder::where('etatBes', $das[0]->eb)->where('description', $prod->produit)->get()[0]->quantite}}</td><td>{{ App\Models\Article::firstWhere('id', $prod->produit)->unite}}</td>

                                            <td>$ {{ App\Models\PrixPv::where('proforma', $prof[0]->id)->where('produit', $prod->produit)->where('pv', $pvs[0]->id)->get()[0]->prix }}</td>

                                            <td>$ {{ App\Models\PrixPv::where('proforma', $prof[0]->id)->where('produit', $prod->produit)->where('pv', $pvs[0]->id)->get()[0]->prix * App\Models\ProductOder::where('etatBes', $das[0]->eb)->where('description', $prod->produit)->get()[0]->quantite }}</td>
                                        </tr>

                                    @endforeach

                                    <tr>
                                        <th><strong>Total</strong></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><strong>$ {{$some}}</strong></th>
                                    </tr>

                                @endif
                            </table>

                        </div>
                    </div>
                    <hr>







                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>Directeur Administratif et Financier</strong></th><th><strong>Secrétaire Exécutif(-ve)</strong></th>
                                </tr>
                                <tr>
                                    <td>
                                        <span></span><br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                            Le {{$valid1[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span></span><br><br>
                                        @if (isset($valid2[0]) && !empty($valid2[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid2[0]->user)->name}}<br>
                                            Le {{$valid2[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid2[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>
                                </tr> 
                            </table>

                        </div>
                        <div class="col-lg-12" style="text-align: center">
                            @if (isset($valid2[0]) && !empty($valid2[0]))

                            <img class="cache" src="{{ asset('storage/img/cache/fondation.png')}}" style="text-align: center;float:center;margin:auto;margin-top:-80px;width:200px;height:200px" />

                            @endif
                        </div>
                    </div>



                    <footer >
                        <hr>
                        <p>
                            <strong>Fondation Panzi</strong><br>
                            Avenue Jean Miruho 3,N<sup>o</sup>024, Quartier PANZI,<br>
                            Commune d'Ibanda, Ville de Bukavu en RB Congo<br>
                            <a href="fondationpanzirdc.org">panzi.org</a>
                            <span style="text-align: right;float:right">Par <strong>{{Auth::user()->name}}</strong></span>

                        </p>
                    </footer>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="imprimer('printBc')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>
