<div>

    <div class="modal fade" id="pMvntModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mouvement au travail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printMvnt">
                    <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h3>MOUVEMENT AU TRAVAIL</h3>
                                <p class="center">N<sup>o</sup> : <b>@if ($mvnt)
                                    {{$mvnt[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">

                    <div class="row">
                        @if ($mvnt)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Nom du demandeur : <strong>{{ App\Models\Agent::firstWhere('id', $mvnt[0]->agent)->firstname}} {{ App\Models\Agent::firstWhere('id', $mvnt[0]->agent)->lastname}} {{ App\Models\Agent::firstWhere('id', $mvnt[0]->agent)->middlename}}</strong></p>
                                <p>Service du demandeur : <strong>{{ App\Models\Service::where('id',App\Models\Agent::firstWhere('id', $mvnt[0]->agent)->service)->get()[0]->name}}</strong></p>
                                <p>Projet du demandeur : <strong>{{ App\Models\Projet::where('id',App\Models\Affectation::where('agent',$mvnt[0]->agent)->get()[0]->projet)->get()[0]->name}}</strong></p>
                                <p>Poste du demandeur : <strong>{{ App\Models\Affectation::where('agent',$mvnt[0]->agent)->get()[0]->poste}}</strong></p>
                                <p>Motif : <strong>{{$mvnt[0]->motif}}</strong></p>
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>Date : <strong>{{$mvnt[0]->created_at->format('d/m/Y')}}</strong></p><br>
                                <p>H/Sortie : <strong>{{$mvnt[0]->depart}}</strong></p>
                                <p>H/Rentrée : <strong>{{$mvnt[0]->retour}}</strong></p>
                                <p>Destination : <strong>{{$mvnt[0]->destination}}</strong></p>
                            </div>
                        @endif

                    </div>

                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>Chef de service</strong></th><th><strong>Resouces humaines</strong></th>
                                </tr>
                                <tr>

                                    <td>
                                        <br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                            Le {{$valid1[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <br><br>
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
                    <button class="btn btn-primary" onclick="imprimer('printMvnt')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
