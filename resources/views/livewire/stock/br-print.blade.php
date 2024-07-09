<div>

    <div class="modal fade" id="pBrModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de reception</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printBrr">
                    <div class="row">

                        <div class="col-lg-6 fix" style="">
                            <div>
                                <br>
                                <h3>BON DE RECEPTION</h3>
                                <p class="">N<sup>o</sup> : <b>@if ($ebs)
                                    {{$br[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>
                        <div class="col-lg-3 fix" style="">
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">

                    <div class="row">
                        @if ($fournisseur)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Fournisseur : <strong>{{$fournisseur[0]->name}}</strong></p>
                                <p>Adresse : <strong>{{ $fournisseur[0]->adresse}}</strong></p>
                                <p>Telephone : <strong>{{ $fournisseur[0]->phone}}</strong></p>
                                <p>N<sup>o</sup> Bordereau : <strong>{{ $br[0]->bordereau}}</strong></p>
                                <p>Lieu : <strong>{{ $br[0]->lieu}}</strong></p>

                                <p>Statut : <strong>{{ $br[0]->etat}}</strong></p>
                                
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>DA-Ref : <strong>{{ $das[0]->reference}}</strong></p>
                                <p>BC-Ref : <strong>{{ $bc[0]->reference}}</strong></p>
                                <p>Projet : <strong>{{ App\Models\Projet::firstWhere('id', $ebs[0]->projet)->name}}</strong></p>
                                <p>Date : <strong>{{$br[0]->created_at->format('d/m/Y')}}</strong></p>
                                
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 prodT">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>Designation</strong></th><th><strong>Observation</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)
                                        <tr>
                                            <td>{{$i++}}</td><td>{{$prod->quantite}}</td><td>{{ App\Models\Article::firstWhere('id', $prod->produit)->unite}}</td><td>{{App\Models\Product::firstWhere('id', App\Models\Article::firstWhere('id', $prod->produit)->product)->name}} {{App\Models\Article::firstWhere('id', $prod->produit)->marque}} {{App\Models\Article::firstWhere('id', $prod->produit)->model}} {{App\Models\Article::firstWhere('id', $prod->produit)->description}}</td><td>{{$prod->observation}}</td>
                                        </tr>
                                    @endforeach

                                @endif
                            </table>

                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>Pour la livraison</strong></th><th><strong>Pour la verification</strong></th><th><strong>Pour la reception</strong></th>
                                </tr>
                                <tr>
                                    <td>
                                        @if (isset($br[0]) && !empty($br[0]))
                                            <br>

                                            <p class="center" >{{ $br[0]->personne}}<br>
                                            Le {{$ebs[0]->created_at->format('d/m/Y')}}</p>
                                       

                                    @endif
                                    </td>

                                    <td>
                                        @if (isset($br[0]) && !empty($br[0]))

                                            

                                        @endif
                                    </td>

                                    <td>
                                        @if (isset($br[0]) && !empty($br[0]))
                                        <br>

                                            <p class="center" >{{ App\Models\User::firstWhere('id', $br[0]->signature)->name}}<br>
                                            Le {{$ebs[0]->created_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $ebs[0]->agent)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>
                                </tr>
                            </table>

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
                    <button class="btn btn-primary" onclick="imprimer('printBrr')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
