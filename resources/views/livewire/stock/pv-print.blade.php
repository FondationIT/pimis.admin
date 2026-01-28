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

                    @if ($bailleur)
                        @if ($bailleur[0]->min1 <= $some && $some <= $bailleur[0]->max1)
                            <header>
                                <div class="row bheader">
                                    <div class="col-lg-6 fix" style="">
                                        <div>
                                            <br>
                                            <h4>COTATION</h4>
                                            <p class="">N<sup>o</sup> : <b>@if ($pvs)
                                                {{$pvs[0]->reference}}
                                            @endif</b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 fix" style="text-align: center">
                                    </div>

                                    <div class="col-lg-3 fix" style="text-align: center">
                                        <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                                    </div>
                                </div>
                            </header>

                            <hr class="mbtm">


                            <div class="row">
                                @if ($pvs)



                                <div class="col-sm">
                                    <h5>Fournisseur: {{App\Models\Fournisseur::firstWhere('id', $proforma[0]->fournisseur)->name}}</h5><br>
                                    <div class="table-wrap">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-border mb-0 prodT">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Articles</strong></td>
                                                        <td><strong>Qté</strong></td>
                                                        <td><strong>Unite</strong></td>
                                                        <td><strong>P.U</strong></td>
                                                        <td><strong>P.T</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product as $prod)
                                                        <tr>

                                                            <td>{{App\Models\Product::firstWhere('id', App\Models\Article::firstWhere('id', $prod->description)->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}}</td>
                                                            <td>{{$prod->quantite}}</td>
                                                            <td>{{App\Models\Article::firstWhere('id', $prod->description)->unite}}</td>
                                                            @foreach ($proforma as $prof)
                                                            <td>
                                                            $ {{ App\Models\PrixPv::where('produit', $prod->description)->where('proforma', $prof->id)->get()[0]->prix}}
                                                            </td>
                                                            <td>
                                                                <strong>$  {{ App\Models\PrixPv::where('produit', $prod->description)->where('proforma', $prof->id)->get()[0]->prix * $prod->quantite}}</strong>
                                                            </td>
                                                            

                                                            @endforeach

                                                        </tr>

                                                    @endforeach
                                                    <tr>
                                                        <td style="text-align: center" colspan="3"><strong class="center">Total</strong></td>
                                                        @foreach ($proforma as $prof)
                                                            @if($da)
                                                                <td style="text-align: center" colspan="2">
                                                                    <strong>$ {{App\Models\ProductOder::join('prix_pvs', 'prix_pvs.produit', '=', 'product_oders.description')
                                                                    ->selectRaw("prix_pvs.prix * product_oders.quantite as price")
                                                                    ->where('prix_pvs.proforma', $prof->id)
                                                                    ->where('product_oders.etatBes', $da[0]->eb)
                                                                    ->get('price')
                                                                    ->sum('price');}}</strong>
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div><hr>

                                @endif
                            </div>
                        @else
                            <header>
                                <div class="row bheader">
                                    <div class="col-lg-6 fix" style="">
                                        <div>
                                            <br>
                                            <h4>PROCES VERBAL D’OUVERTURE ET ANALYSE</h4>
                                            <p class="">N<sup>o</sup> : <b>@if ($pvs)
                                                {{$pvs[0]->reference}}
                                            @endif</b></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 fix" style="text-align: center">
                                    </div>

                                    <div class="col-lg-3 fix" style="text-align: center">
                                        <img src="{{ asset('img/logo/logo1.png')}}" class="droite" style="width: 200px;position: relative;text-align: center" />
                                    </div>
                                </div>
                            </header>

                            <hr class="mbtm">


                            <div class="row">
                                @if ($pvs)



                                <div class="col-sm">
                                    <h5>Tableau comparatif</h5><br>
                                    <div class="table-wrap">
                                        <div class="table-responsive" >
                                            <table class="table table-striped table-border mb-0 prodT">
                                                <thead>
                                                    <tr>
                                                        <td rowspan="2"><strong>Articles</strong></td>
                                                        <td rowspan="2"><strong>Qté</strong></td>
                                                        <td rowspan="2"><strong>Unite</strong></td>
                                                        @foreach ($proforma as $prof)
                                                        <td colspan="2"><strong>{{App\Models\Fournisseur::firstWhere('id', $prof->fournisseur)->name}}</strong></td>

                                                        @endforeach
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
                                                        <tr>

                                                            <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}}</td>
                                                            <td>{{$prod->quantite}}</td>
                                                            <td>{{App\Models\Article::firstWhere('id', $prod->description)->unite}}</td>
                                                            @foreach ($proforma as $prof)
                                                                @php
                                                                    try {
                                                                        $prixPvInstance = App\Models\PrixPv::where('produit', $prod->description)
                                                                            ->where('proforma', $prof->id)
                                                                            ->first();

                                                                        if ($prixPvInstance) {
                                                                            $prix = rtrim(rtrim($prixPvInstance->prix, '0'), '.') ?? 0;
                                                                            $prixTotal = $prix * $prod->quantite;

                                                                            $totalAmount[$prof->id] += $prixTotal;
                                                                @endphp

                                                                            <td>
                                                                                $ {{ number_format($prix,0,',','.'); }}
                                                                            </td>

                                                                            <td>
                                                                                <strong>$ {{ number_format($prixTotal,0,',','.'); }}</strong>
                                                                            </td>

                                                                @php
                                                                        } else {
                                                                @endphp
                                                                            <td> 0.00 </td>
                                                                            <td> 0.00 </td>

                                                                @php
                                                                        }
                                                                    } catch (\Exception $e) {
                                                                @endphp

                                                                    <td colspan="2">Error: {{ $e->getMessage() }}</td>

                                                                @php
                                                                    }
                                                                @endphp
                                                            @endforeach


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
                                    </p><br><br>

                                    <p>Ainsi fait à Bukavu, le {{$pvs[0]->created_at->format('d-m-y')}}</p><br>

                                    <h5>Les membres de la commission:</h5><br>

                                </div>


                                <div class="col-lg-12" style="text-align: center">
                                    <table class="table table-striped table-border mb-0">
                                        <tr>
                                            @if($commissionMembers)
                                                @foreach ($commissionMembers as $ag)
                                                    <td>
                                                            <p class="center" >{{ $ag->name}}<br>
                                                            @if(strtolower($ag->is_approved) == 'approved')
                                                                <img class="signn1" src="{{ asset('storage/'.$ag->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top: -20px;" />
                                                            @elseif(strtolower($ag->is_approved) == 'rejected')
                                                                <span class="text-danger">Rejeté</span>
                                                            @else
                                                                <span class="badge badge-warning">En attente</span>
                                                            @endif
                                                            </p>

                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    </table>
                                </div>

                                @endif
                            </div>
                        @endif
                    @endif


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
                    <button class="btn btn-primary" onclick="imprimer('printPv')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>



