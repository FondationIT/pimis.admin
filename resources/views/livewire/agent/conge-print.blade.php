<div>

    <div class="modal fade" id="pCongeModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Demamde de congé</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printConge">
                    <div class="row">

                       

                        <div class="col-lg-6 fix" style="">
                            <div>
                                <br>
                                <h3>DEMANDE DE CONGE</h3>
                                <p class="">N<sup>o</sup> : <b>@if ($conge)
                                    {{$conge[0]->reference}}
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
                        @if ($conge)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Nom du demandeur : <strong>{{ App\Models\Agent::firstWhere('id', $conge[0]->agent)->firstname}} {{ App\Models\Agent::firstWhere('id', $conge[0]->agent)->lastname}} {{ App\Models\Agent::firstWhere('id', $conge[0]->agent)->middlename}}</strong></p>
                                <p>Service du demandeur : <strong>{{ App\Models\Service::where('id',App\Models\Agent::firstWhere('id', $conge[0]->agent)->service)->get()[0]->name}}</strong></p>





                                <<p>Projet du demandeur : <strong>{{ App\Models\Projet::where('id',App\Models\Affectation::where('agent',$conge[0]->agent)->get()[0]->projet)->get()[0]->name}}</strong></p>
                                <p>Poste du demandeur : <strong>{{ App\Models\Affectation::where('agent',$conge[0]->agent)->get()[0]->poste}}</strong></p>
                                <p>Motif : <strong>{{$conge[0]->motif}}</strong></p>
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>Date : <strong>{{$conge[0]->created_at->format('d/m/Y')}}</strong></p><br>
                                <p>Date depart: <strong>{{$conge[0]->debut}}</strong></p>
                                <p>Date Retour : <strong>{{$conge[0]->fin}}</strong></p>
                            </div>
                        @endif

                    </div>

                    

                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: left">
                            <table class="table table-striped table-border mb-0 prodT">
                                @if ($conge)
                                    <tr>
                                        <th><strong>Congé</strong></th><th><strong>Cumulé</strong></th><th><strong>Demandé</strong></th><th><strong>Accordé</strong></th><th><strong>Solde</strong></th>
                                    </tr>
                                    @if($conge[0]->type == 1)
                                        <tr>
                                            <td>Annuel</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 2)
                                        <tr>
                                            <td>Deces 1er degre</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 3)
                                        <tr>
                                            <td>Deces 2er degre</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 4)
                                        <tr>
                                            <td>Mariage</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 5)
                                        <tr>
                                            <td>Maternite/Paternite</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 6)
                                        <tr>
                                            <td>Recuperation</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 7)
                                        <tr>
                                            <td>Demenagement</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif

                                    @if($conge[0]->type == 8)
                                        <tr>
                                            <td>Non paye</td><td></td><td>{{$conge[0]->dure}} Jour(s)</td><td>{{$conge[0]->dure}} Jour(s)</td><td></td>
                                        </tr>
                                    @endif
                                @endif
                                
                                  

                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <p><br>N.B: Le travailleur n'est pas autorisé à cumilé au delà de 2 ans;<br>
                                Dans le cas de congé maladies,il faudra annexer à ce formulaire les pièces justificative;<br>
                                Ce formulaire sera photocopié en trois exemplaire reapartes comme suit:
                            </p><br>
                        </div>

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
                            <a href="fondationpanzirdc.org">panzi.org</a>
                            <span style="text-align: right;float:right">Par <strong>{{Auth::user()->name}}</strong></span>

                        </p>
                    </footer>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="imprimer('printConge')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
