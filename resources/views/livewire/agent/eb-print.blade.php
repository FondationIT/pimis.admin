<div>

    <div class="modal fade" id="pEtBesModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Etat de besoin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printBr">
                    <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h3>BON DE REQUISITION</h3>
                                <p class="center">N<sup>o</sup> : <b>@if ($ebs)
                                    {{$ebs[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">

                    <div class="row">
                        @if ($ebs)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Nom du demandeur : <strong>{{ App\Models\User::firstWhere('id', $ebs[0]->agent)->name}}</strong></p>
                                <p>Projet du demandeur : <strong>{{ App\Models\Projet::firstWhere('id', $ebs[0]->projet)->name}}</strong></p>
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>Date : <strong>{{$ebs[0]->created_at->format('d/m/Y')}}</strong></p>
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 prodT">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>Designation</strong></th><th><strong>Detail</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)
                                        <tr>
                                            <td>{{$i++}}</td><td>{{$prod->quantite}}</td><td>{{ App\Models\Article::firstWhere('id', $prod->description)->unite}}</td><td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}} </td><td>{{App\Models\Article::firstWhere('id', $prod->description)->description}}</td>
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
                                    <th><strong>Etabli par</strong></th><th><strong>Verifier par</strong></th><th><strong>Approuver par</strong></th>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Agent</span><br><br>
                                        @if (isset($ebs[0]) && !empty($ebs[0]))

                                            <p class="center" >{{ App\Models\User::firstWhere('id', $ebs[0]->agent)->name}}<br>
                                            Le {{$ebs[0]->created_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $ebs[0]->agent)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span>Comptable</span><br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                            Le {{$valid1[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span>Chef Projet</span><br><br>
                                        @if (isset($valid2[0]) && !empty($valid2[0]))
                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid2[0]->user)->name}}<br>
                                                Le {{$valid2[0]->updated_at->format('d/m/Y')}}
                                            </p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid2[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
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
                            <a href="fondationpanzirdc.org">fondationpanzirdc.org</a>
                            <span style="text-align: right;float:right">Par <strong>{{Auth::user()->name}}</strong></span>

                        </p>
                    </footer>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="imprimer('printBr')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
