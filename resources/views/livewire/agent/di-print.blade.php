<div>

    <div class="modal fade" id="pDiModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Demande interne</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printDi">
                    <div class="row">

                        <div class="col-lg-6 fix" style="">
                            <div>
                                <br>
                                <h3>DEMANDE INTERNE</h3>
                                <p class="">N<sup>o</sup> : <b>@if ($dis)
                                    {{$dis[0]->reference}}
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
                        @if ($dis)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Nom du demandeur : <strong>{{ App\Models\User::firstWhere('id', $dis[0]->agent)->name}}</strong></p>
                                <p>Projet du demandeur : <strong>{{ App\Models\Projet::firstWhere('id', $dis[0]->projet)->name}}</strong></p>
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>Date : <strong>{{$dis[0]->created_at->format('d/m/Y')}}</strong></p>
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 prodT">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>Designation</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)
                                        <tr>
                                            <td>{{$i++}}</td><td>{{$prod->quantite}}</td><td>{{ App\Models\Article::firstWhere('id', $prod->product)->unite}}</td><td>{{App\Models\Product::firstWhere('id', App\Models\Article::firstWhere('id', $prod->product)->product)->name}} {{App\Models\Article::firstWhere('id', $prod->product)->marque}} {{App\Models\Article::firstWhere('id', $prod->product)->model}} {{App\Models\Article::firstWhere('id', $prod->product)->description}}</td>
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
                                    <th><strong>Etabli par</strong></th><th><strong>Verifier par</strong></th>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Agent</span><br><br>
                                        @if (isset($dis[0]) && !empty($dis[0]))

                                            <p class="center" >{{ App\Models\User::firstWhere('id', $dis[0]->agent)->name}}<br>
                                            Le {{$dis[0]->created_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $dis[0]->agent)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span>Chef Projet</span><br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))
                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                                Le {{$valid1[0]->updated_at->format('d/m/Y')}}
                                            </p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
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
                    <button class="btn btn-primary" onclick="imprimer('printDi')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
