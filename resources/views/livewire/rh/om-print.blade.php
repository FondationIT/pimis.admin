<div>

    <div class="modal fade" id="pMissionModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printMission">
                    <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h3>ORDRE DE MISSION</h3>
                                <p class="center">N<sup>o</sup> : <b>@if ($ms)
                                    {{$ms[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">

                    <div class="row">
                        @if ($ms)
                            <div class="col-lg-12" >
                                <p>Délivré à:
                                    <ul>
                                        @foreach ($agent as $ag)
                                            <li>- {{ App\Models\Agent::firstWhere('id', $ag->agent)->firstname}} {{ App\Models\Agent::firstWhere('id', $ag->agent)->lastname}} {{ App\Models\Agent::firstWhere('id', $ag->agent)->middlename}}</li>
                                        @endforeach
                                    </ul>
                                </p>

                                <p>Sont chargés d'effectuer une mission de service à <strong>{{$ms[0]->itinéraire}}</strong></p><br>

                                <p>Objectif de la mission : <strong>{{App\Models\Tr::firstWhere('id', $ms[0]->tr)->titre}}</strong></p>
                                <p>Dure de la mission : <strong>{{$ms[0]->dure}} Nuités</strong></p>
                                <p>Date prevue : <strong>{{$ms[0]->debut}}</strong></p>
                                <p>Retour prevu : <strong>{{$ms[0]->fin}}</strong></p>
                                <p>Moyen de transport : <strong>{{$ms[0]->moyen}}</strong></p>
                                <p>Itinéraire à suivre : <strong>{{$ms[0]->itinéraire}}</strong></p>
                                <p>Destination : <strong>{{$ms[0]->destination}}</strong></p><br>

                                <p>
                                    Les autorités tant civiles que militaires sont priées de leur apporter toutes les facilités compatibles
                                    avec la législation en vigueur pour l'accomplissement de leur mission.
                                </p>
                                
                            </div>
                        @endif

                    </div>

                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>Resouces humaines</strong></th>
                                </tr>
                                <tr>

                                    <td>
                                        <br>
                                        @if ($ms)

                                            <p>Fait à Bukavu Le {{$ms[0]->updated_at->format('d/m/Y')}}</p><br><br>

                                            <p class="center">{{ App\Models\User::firstWhere('id', $ms[0]->signature)->name}}<br>
                                            </p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $ms[0]->signature)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

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
                    <button class="btn btn-primary" onclick="imprimer('printMission')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>