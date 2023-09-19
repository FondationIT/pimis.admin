<div>

    <div class="modal fade" id="pPvModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proces Verbale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printPv">

                    <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h4>PROCES VERBAL D’OUVERTURE ET ANALYSE</h4>
                                <p class="center">N<sup>o</sup> : <b>@if ($pvs)
                                    {{$pvs[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">

                    <div class="row">
                        @if ($pvs)



                        <div class="col-sm">
                            <h5>Tableau comparatif</h5><br>
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Fournisseur</th>
                                                <th>Unite</th>
                                                @foreach ($proforma as $prof)
                                                <th>{{App\Models\Fournisseur::firstWhere('id', $prof->fournisseur)->name}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $prod)
                                                <tr>

                                                    <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}}</td>
                                                    <td>{{App\Models\Article::firstWhere('id', $prod->product)->unite}}</td>
                                                    @foreach ($proforma as $prof)
                                                    <td>
                                                       <strong>$ {{ App\Models\PrixPv::where('produit', $prod->description)->where('proforma', $prof->id)->get()[0]->prix}}</strong>
                                                    </td>
                                                    @endforeach

                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div><hr>



                        
                        <div class="col-lg-12">
                            <br>
                            <p>L’an <strong>{{date('Y', strtotime($pvs[0]->dateC))}}</strong>, le <strong>{{$pvs[0]->created_at->format('d')}}<sup>èm</sup></strong> jour du mois de <strong>{{$pvs[0]->created_at->format('F')}}</strong>,<br>
                                Nous membres de la commission de <strong>{{$pvs[0]->titre}}</strong> réunis, nous avons procédé a (l’ouverture), a (l’analyse), a (l’attribution) du marché <strong>{{$pvs[0]->titre}}</strong>. (d’entreprises), (des firmes) ont été consultées.
                            </p><br>

                            <p>
                                A la date de clôture, <strong>{{date('d-m-Y', strtotime($pvs[0]->dateC))}}</strong> ont répondu favorablement en déposant leurs offres sous plis fermés. 
                            </p>

                            <p>
                                La commission constituée a cet effet s’est réunie pour tabler sur les dossiers et a fait des observations suivantes :
                            </p>
                            <p>
                                {{$pvs[0]->observation}}
                            </p><br>

                            <p>
                                Etant donne ce qui précède, se basant sur le rapport (qualité-prix), (expérience), évaluation (administrative), (technique), (financière), (disponibilité), la commission (propose), (recommande), (décide): {{$pvs[0]->justification}} 
                            </p><br><br>

                            <p>Ainsi fait à Bukavu, le {{$pvs[0]->created_at->format('d-m-y')}}</p><br>

                            <h5>Les membres de la commission:</h5><br>
                            
                        </div>

                        @foreach ($agent as $ag)
                            <div class="col-lg-12">
                                <ol>
                                    <li>
                                        {{ App\Models\User::firstWhere('agent', $ag->agent)->name}}
                                        
                                        <img class="signn1" src="{{ asset('storage/'.App\Models\User::firstWhere('agent', $ag->agent)->signature)}}" style="position: relative;width:200px;margin-top:-10px;text-align:left" />
                                    </li>
                                </ol>
                            </div>
                        @endforeach

                        @endif
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
                    <button class="btn btn-primary" onclick="imprimer('printPv')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>



