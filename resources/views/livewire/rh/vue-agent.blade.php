<div>


    <!-- Modal Agent -->

    <div class="modal fade" tabindex="-1" id="aAgentModalForms" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header profile-cover-wrap overlay-wrap">
                    <div class="bg-overlay bg-trans-dark-60" style="border-raduis:5px"></div>
                    <div class="container profile-cover-content py-50">
                        <div class="hk-row"> 
                            <div class="col-lg-7">
                                <div class="media align-items-center">
                                    <div class="d-flex media-img-wrap mr-15">
                                        <div class="avatar avatar-xl">
                                            @if($agent)
                                            <span class="avatar-text avatar-text-inv-pink rounded-circle"><span class="initial-wrap"><span>{{substr($agent->firstname, 0, 1).substr($agent->lastname, 0, 1)}}</span></span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        @if($agent)
                                            <div class="text-white text-capitalize display-6 mb-5 font-weight-400">{{$agent->firstname}} {{$agent->lastname}} {{$agent->middlename}}</div>
                                            <div class="font-14 text-white">
                                                <span class="mr-5">
                                                    @if($agent->gender == 'Masculin')
                                                        <span class="mr-5">Homme</span>    
                                                    @else
                                                        <span class="mr-5">Femme</span>  
                                                    @endif
                                                </span>
                                                <span class="mr-5">/   {{$statut->etatcivil}}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                @if($agent)
                                <ul>
                                    <li class="list-group-item"><span class=" text-green mr-3 font-20"><i class="fa fa-phone"></i></span><span class="">{{$agent->phone}}</span></li>
                                    <li class="list-group-item"><span class=" text-primary mr-3 font-20"><i class="fa fa-at"></i></span><span class="">{{$agent->email}}</span></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="row text-center">
                            @if($agent)
                            <div class="col-4 border-right pr-0">
                                <div class="pa-15">
                                    <span class="d-block display-6 text-dark mb-5">154</span>
                                    <span class="d-block text-capitalize font-14">Contrats</span>
                                </div>
                            </div>
                            <div class="col-4 border-right px-0">
                                <div class="pa-15">
                                    <span class="d-block display-6 text-dark mb-5">65</span>
                                    <span class="d-block text-capitalize font-14">Affectations</span>
                                </div>
                            </div>
                            <div class="col-4 pl-0">
                                <div class="pa-15">
                                    <span class="d-block display-6 text-dark mb-5">{{$statut->enfant}}</span>
                                    <span class="d-block text-capitalize font-14">Enfants</span>
                                </div>
                            </div>
                            @endif
                        </div><hr>
                        <div class="row text-center">
                            <div class="col-4 border-right pr-0">
                                <div class="pa-15">
                                    <p><strong><u>Infornations demographiques</u></strong></p><br>
                                    @if($agent)
                                    <p>
                                        <strong>Date et lieu de naissance:</strong>
                                        <br><span class="d-block text-capitalize font-14">{{$agent->lieu}}  {{$agent->birthdate}}</span>
                                    </p><br>
                                    
                                    <p>
                                        <strong>Adresse</strong>
                                        <br><span class="d-block text-capitalize font-14">{{$agent->adress}}  {{$agent->region}} {{$agent->country}}</span>
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-8 px-0">
                                <div class="pa-15">
                                    <p><strong><u>Informations proffetionnelles</u></strong></p><br>
                                    <div class="row">
                                        <div class="col-lg-6 border-right pa-15" style="text-align: center">  
                                         <strong>Affectation</strong><br>
                                         @if(!empty($affectation[0]))
                                            <div style="padding:10px;text-align:right">
                                                @foreach ($affectation as $aff)
                                                    <p><strong>Projet: </strong><span class="text-capitalize font-14">{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</span></p>                   
                                                    <p><strong>Poste: </strong><span class="text-capitalize font-14">{{$aff->poste}}</span><br>
                                                    <strong>Lieu: </strong><span class="text-capitalize font-14">{{$aff->lieu}}</span></p><br>
                                                @endforeach
                                            </div> 
                                         @else
                                            <span class="text-capitalize font-14">Aucune affectation</span>     
                                         @endif
                                        </div>
                                        <div class="col-lg-6 pa-15" style="text-align: center">
                                            <strong>Contrat:</strong><br>
                                             @if(!empty($contrat[0]))
                                                <div style="padding:10px;text-align:left">
                                                    <p><strong>Statut: </strong>{{$contrat[0]->satatut}}</p>
                                                    <p><strong>Type: </strong>{{$contrat[0]->type}}</p>
                                                    <p><strong>Debut: </strong>{{$contrat[0]->debut}}</p>
                                                    <p><strong>Fin: </strong>{{$contrat[0]->fin}}</p>
                                                    <p><strong>Projet: </strong>{{App\Models\Projet::firstWhere('id', $contrat[0]->projet)->name}}</p>
                                                </div>
                                             @else
                                                <span class="text-capitalize font-14">Aucun contrat en cours</span> 
                                             @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><hr>
                        <div class="row"> 
                            <div class="col-lg-12" style="text-align: center">
                                <p>
                                    <strong>Personne à contacter</strong>
                                    <br>
                                    @if(!empty($agent->nom2))
                                    <strong>Nom: </strong>{{$agent->nom2}}<br>
                                    <strong>Tel: </strong>{{$agent->contact}}
                                    @else
                                    <span class="text-capitalize font-14">Aucune personne</span>     
                                    @endif

                                </p>
                            </div>
                            <div class="col-lg-6">
                                
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">Anuler</button>
                </div>
            </div>

        </div>
    </div>


</div>
