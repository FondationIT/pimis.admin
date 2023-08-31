<div>

    <div class="modal fade" id="pDaModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Demmande d'achat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printDa">
                    <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h3>DEMMANDE D'ACHAT</h3>
                                <p class="center">N<sup>o</sup> : <b>@if ($ebs)
                                    {{$das[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm">

                    <div class="row" >
                        @if ($ebs)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Projet : <strong>{{ App\Models\Projet::firstWhere('id', $ebs[0]->projet)->name}}</strong></p>
                                <p>Motif : <strong>{{$das[0]->motif}}</strong></p>
                               
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>EB-Ref : <strong>{{ $ebs[0]->reference}}</strong></p>
                                <p>Date : <strong>{{$das[0]->created_at->format('d/m/Y')}}</strong></p>
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0 prodT">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>ligne</strong></th><th><strong>Design</strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>P.U.E</strong></th><th><strong>P.T.E</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)
                                        <tr>

                                            <td>{{$i++}}</td>
                                            <td>@if (Auth::user()->role == 'D.A.F' && $das[0]->niv4 == false)<a href="#" class="p-1 text-teal-600 hover:bg-teal-600"  data-toggle="modal" data-target="#ligneArtModalForms"  rounded wire:click="ligneArt({{$prod->id}})" data-toggle="modal" data-target="">{{ $prod->ligne }}</a>@else{{ $prod->ligne }}@endif</td>
                                            <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}} {{App\Models\Article::firstWhere('id', $prod->description)->description}}</td>

                                            <td>{{$prod->quantite}}</td><td>{{ App\Models\Article::firstWhere('id', $prod->product)->unite}}</td>

                                            <td>$ {{ App\Models\Price::where('product', $prod->description)->whereDate('debut','<=', $this->das[0]->created_at)->whereDate('fin','>=', $this->das[0]->created_at)->get()[0]->prix}}</td>

                                            <td>$ {{ App\Models\Price::where('product', $prod->description)->whereDate('debut','<=', $this->das[0]->created_at)->whereDate('fin','>=', $this->das[0]->created_at)->get()[0]->prix * $prod->quantite }}</td>

                                            
                                        </tr>

                                    @endforeach
                                    <tr>
                                        <th><strong>Total</strong></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><strong>$ {{$some}}</strong></th>
                                    </tr>

                                @endif
                            </table>

                        </div>
                    </div>
                    <hr style="padding:0px;margin:0px">
                        <span style="font-size: 12px;padding:0px;margin:0px">Adresse de Livraison/ Contact/ Instructions Spéciales - L'achat s'effectuera si le coût réel ne dépasse pas soit le coût estimatif de plus de 10% soit 2000 $. Au-delà, la DA doit être revue et approuvée à nouveau.</span>
                    <hr style="padding:0px;margin:0px">
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>Demmandeur</strong></th><th><strong>Logistique</strong></th><th><strong>Finance</strong></th><th><strong>Projet/Service</strong></th><th><strong>DAF</strong></th>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Agent</span><br><br>
                                        @if (isset($das[0]) && !empty($das[0]))

                                            <p class="center" >{{ App\Models\User::firstWhere('id', $das[0]->signature)->name}}<br>
                                            Le {{$das[0]->created_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $das[0]->signature)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span>Logistique</span><br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                            Le {{$valid1[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span>Comptable</span><br><br>
                                        @if (isset($valid2[0]) && !empty($valid2[0]))
                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid2[0]->user)->name}}<br>
                                                Le {{$valid2[0]->updated_at->format('d/m/Y')}}
                                            </p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid2[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
                                        @endif
                                    </td>

                                    <td>
                                        <span>Chef Projet</span><br><br>
                                        @if (isset($valid3[0]) && !empty($valid3[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid3[0]->user)->name}}<br>
                                            Le {{$valid3[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid3[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>

                                    <td>
                                        <span>DAF</span><br><br>
                                        @if (isset($valid4[0]) && !empty($valid4[0]))
                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid4[0]->user)->name}}<br>
                                                Le {{$valid4[0]->updated_at->format('d/m/Y')}}
                                            </p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid4[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
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
                    <button class="btn btn-primary" onclick="imprimer('printDa')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>
