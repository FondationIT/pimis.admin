<div>

    <div class="modal fade" id="pPvAttrModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proces Verbale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body" id="printPvAttr">
                    <div class="row bheader">
                        <div class="col-lg-6 fix" style="">
                            <div>
                                <br>
                                <h4>PROCES VERBAL D’OUVERTURE, ANALYSE ET <br>ATTRIBUTION DE MARCHE</h4>
                                <p class="">N<sup>o</sup> : <b>@if ($pvs)
                                    {{$pvs->reference}}
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
                        @if ($pvs)



                        <div class="col-sm">
                            <h5>Tableau comparatif</h5><br>
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table table-striped table-border mb-0 prodT pv-table">
                                        <thead>
                                            <tr>
                                                <td class="tb-article" rowspan="2"><strong>Articles</strong></td>
                                                <td rowspan="2"><strong>Qté</strong></td>
                                                <td rowspan="2"><strong>Unite</strong></td>
                                                @foreach ($proforma as $prof)
                                                    <td colspan="2"><strong>{{App\Models\Fournisseur::where('id', $prof->fournisseur)->first()->name}}</strong></td>
                                                @endforeach
                                                <td rowspan="2"><strong>Attr</strong></td>
                                            </tr>
                                            <tr> 
                                                @foreach ($proforma as $prof)
                                                <td><strong>P.U</strong></td>
                                                <td><strong>P.T</strong></td>
                                                @endforeach
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalAmount = [];
                                                foreach($proforma as $prof){
                                                    $totalAmount[$prof->id] = 0;
                                                }
                                            @endphp
                                            @foreach ($product as $prod)
                                                @php
                                                    $article = App\Models\Article::find($prod->description);
                                                    $product = $article ? App\Models\Product::find($article->product) : null;
                                                @endphp
                                                <tr>
                                                    <td class="tb-article">
                                                        {{ $product->name ?? '' }}
                                                        {{ $article->marque ?? '' }}
                                                        {{ $article->model ?? '' }}
                                                    </td>
                                                    <td>{{ $prod->quantite }}</td>
                                                    <td>{{ $article->unite ?? '' }}</td>

                                                    @foreach ($proforma as $prof)
                                                        @php
                                                            try {
                                                                $prixPv = App\Models\PrixPv::where('produit', $prod->description)
                                                                            ->where('proforma', $prof->id)
                                                                            ->first();

                                                                $isSelected = App\Models\SelectPv::where('produit', $prod->description)
                                                                                ->where('proforma', $prof->id)
                                                                                ->exists();

                                                                // $bg = $isSelected ? 'background-color: rgba(175, 175, 175, 0.4)' : '';
                                                                $prixVal = $prixPv ? $prixPv->prix : 0;
                                                                $prix = rtrim(rtrim($prixVal, '0'), '.');
                                                                $prixTotal = $prix * $prod->quantite ?? 0;
                                                                $totalAmount[$prof->id] += $prixTotal;
                                                        @endphp
                                                            @if($isSelected)
                                                                <td style="background-color: rgba(175, 175, 175, 0.4) ">
                                                                $ {{ $prix }}
                                                                </td>
                                                                <td style="background-color: rgba(175, 175, 175, 0.4)">
                                                                    <strong>$  {{ number_format($prixTotal,0,',','.'); }}</strong>
                                                                </td>
                                                            
                                                            @else
                                                                
                                                                <td>
                                                                $ {{ $prix}}
                                                                </td>
                                                                <td>
                                                                    <strong>$  {{ number_format($prixTotal,0,',','.'); }}</strong>
                                                                </td>
                                                            @endif
                                                        @php
                                                            } catch (\Throwable $th) {
                                                                echo '<td>'.$prod->produit.'</td><td>'.$th->getMessage().'</td>';
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    <td></td>

                                                </tr>

                                            @endforeach
                                            <tr>
                                                <td style="text-align: center" colspan="3"><strong class="center">Total</strong></td>
                                                @foreach ($proforma as $prof)
                                                    @if($da)
                                                        <td style="text-align: center" colspan="2">
                                                            <strong>$ {{ number_format($totalAmount[$prof->id],0,',','.'); }}</strong>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div><hr>



                        
                        <div class="col-lg-12">
                            <br>
                            <p>L’an <strong>{{date('Y', strtotime($pv->dateC))}}</strong>, le <strong>{{$pvs->created_at->format('d')}}<sup>èm</sup></strong> jour du mois de <strong>{{$pvs->created_at->format('F')}}</strong>,<br>
                                Nous membres de la commission de <strong>{{$pvs->titre}}</strong> réunis, nous avons procédé a (l’ouverture), a (l’analyse), a (l’attribution) du marché <strong>{{$pvs->titre}}</strong>. (d’entreprises), (des firmes) ont été consultées.
                            </p><br>

                            <p>
                                A la date de clôture, <strong>{{date('d-m-Y', strtotime($pv->dateC))}}</strong> ont répondu favorablement en déposant leurs offres sous plis fermés. 
                            </p>

                            <p>
                                La commission constituée a cet effet s’est réunie pour tabler sur les dossiers et a fait des observations suivantes :
                            </p>
                            <p>
                                {{$pvs->observation}}
                            </p><br>

                            <p>
                                Etant donne ce qui précède, se basant sur le rapport (qualité-prix), (expérience), évaluation (administrative), (technique), (financière), (disponibilité), la commission (propose), (recommande), (décide): {{$pvs->justification}} 
                            </p><br><br>

                            <p>Ainsi fait à Bukavu, le {{$pvs->created_at->format('d-m-y')}}</p><br>

                            <h5>Les membres de la commission:</h5><br>

                            
                            
                        </div>


                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 pv-table">
                                @php
                                    $signature = null;
                                @endphp
                                <tr>
                                    @foreach ($commission_members as $member)
                                        <td class="fw-bold text-uppercase">{{ $member->name }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($commission_members_validation as $key => $validation)
                                        @php
                                            if($key == 'niv_1'){
                                                $signature=App\Models\User::where('role','D.O')->where('active',1)->value('signature');
                                            }
                                            if($key == 'niv_2'){
                                                $signature=App\Models\User::where('role','D.A.F')->where('active',1)->value('signature');
                                            }
                                            if($key == 'niv_3'){
                                                $signature=App\Models\User::where('role','D.P')->where('active',1)->value('signature');
                                            }
                                        @endphp
                                        <td>
                                            @if(is_string($validation))
                                                <span class="secondary" style="font-size: small;">En attente</span>
                                            @elseif(!is_string($validation) && $validation === true)
                                                <img class="signn1" src="{{ asset('storage/'.$signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top: -20px;" />
                                            @else
                                                <span class="text-danger" style="font-size: small;">Rejeté</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>

                        @endif
                    </div>



                    <footer class="bfooter">
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
                    <button class="btn btn-primary" onclick="imprimer('printPvAttr')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>
