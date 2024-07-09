<div>

    <div class="modal fade" id="pTrModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">Terme de reference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body card card-refresh" id="printTr">
                   
                    <div class="row">

                        <div class="col-lg-6 fix" style="">
                            <div>
                                <br>
                                <h3>TERME DE REFERENCE</h3>
                                <p class="">N<sup>o</sup> : <b>@if ($trs)
                                    {{$trs[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm" style="color:  #528FEB">

                    <div class="row">
                        @if ($trs)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Projet : <strong>{{ App\Models\Projet::firstWhere('id', $trs[0]->projet)->name}} ({{ App\Models\Projet::firstWhere('id', $trs[0]->projet)->reference}})</strong></p>
                                
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>Date : <strong>{{$trs[0]->created_at->format('d/m/Y')}}</strong></p>
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 prodT">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>Libellé</strong></th><th><strong>Unité</strong></th><th><strong>Qté</strong></th><th><strong>P.U</strong></th><th><strong>P.T</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)
                                        <tr>
                                            <td>{{$i++}}</td><td>{{$prod->libelle}}</td><td>{{ $prod->unite}}</td><td>{{$prod->quantite}}</td><td>$ {{$prod->prix}}</td><td>$ {{$prod->prix * $prod->quantite}}</td>
                                        </tr>
                                    @endforeach

                                @endif
                                <tr>
                                    <th><strong>Total</strong></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><strong>$ {{$some}}</strong></th>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>Preparé par</strong></th><th><strong>Verifié par</strong></th><th><strong>Validé par</strong></th><th><strong>Approuvé par</strong></th>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Agent</span><br><br>
                                        @if (isset($trs[0]) && !empty($trs[0]))

                                            <p class="center" >{{ App\Models\User::firstWhere('id', $trs[0]->agent)->name}}<br>
                                            Le {{$trs[0]->created_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $trs[0]->agent)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>


                                    <td>
                                        <span>Comptable</span><br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))
                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                                Le {{$valid1[0]->updated_at->format('d/m/Y')}}
                                            </p>
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

                        

                                    <td>
                                        <span>DAF</span><br><br>
                                        @if (isset($valid3[0]) && !empty($valid3[0]))
                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid3[0]->user)->name}}<br>
                                                Le {{$valid3[0]->updated_at->format('d/m/Y')}}
                                            </p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid3[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
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
                    <button class="btn btn-primary" onclick="imprimer('printTr')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>


