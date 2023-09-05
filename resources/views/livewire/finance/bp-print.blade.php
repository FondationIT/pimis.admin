<div>

    <div class="modal fade" id="pBpModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bon de paiement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <style type="text/css" media="print">
                    @page {
                        size: landscape;
                    }
                    table{
                    border-collapse: collapse;
                    }

                    th, td{
                    border: 1px solid black;
                    padding: 10px;
                    }
                </style>

                <div class="modal-body" id="printBp">

                  <!--  <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h3>BON DE PAIEMENT</h3>
                                <p class="center">N<sup>o</sup> : <b>@if ($bcs)
                                    {{$bps[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logo1.png" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm"> -->

                    <table style="border: 1px solid;width: 100%">
                        <tr style="border: 2px solid;width: 100%;text-align:center">
                            <td ><table style="border: 2px solid;width: 100%;text-align:center"><tr>BON DE PAIEMENT</tr></table></td>
                        </tr>
                    </table><br>
                    <table style="border: 1px solid;width: 100%;border-top:none">
            
                        <tr style="border: 2px solid;width: 100%;border-top:none">
                            <td style="width: 49%">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <table style="width: 100%;text-align:left">
                                                <tr>
                                                    @if ($bps)
                                                    <td>Projet :</td>
                                                    <td style="border: 1px solid;text-align:center"><strong>{{ App\Models\Projet::firstWhere('id', $index[0]->projet)->name}}</strong></td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <tr>
                                                    <td>Nom du bureau:</td>
                                                    <td style="border: 1px solid;text-align:center"><strong>FONDATION PANZI</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%">
                                                <br><tr>
                                                    @if ($bps)
                                                    <td>Montant en chifre :</td>
                                                    <td style="border: 1px solid;text-align:center"><strong>{{ $bps[0]->montant}}</strong></td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <BR><tr>
                                                    <td>Devise :</td>
                                                    <td style="border: 1px solid;text-align:center"><strong>USD</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table><br>
                                <table style="width: 100%">
                                    <tr>
                                        @if ($bps)
                                        <td>Montant en lettre:</td>
                                        <td style="border: 1px solid;text-align:center;width:70%"><strong>{{ $bps[0]->montantTL}}</td>
                                        @endif
                                    </tr>
                                </table><br>

                                <table style="width: 100%;text-align:right">
                                    <tr>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <tr>
                                                    <td>Objet: Avance</td>
                                                    <td ></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <tr>
                                                    <td>Remboursement: Liquidqtion:</td>
                                                    <td style="border: 1px solid;text-align:center;width:30%"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table><br>

                                <table style="width: 100%;" >
                                    <tr>
                                        <td>Paye a:</td>
                                        <td style="border: 1px solid;text-align:center;width:70%">
                                            <strong>
                                            @if ($bps)
                                                @if ($bps[0]->categorie == 4 && $bps[0]->beneficiaire == 1 )
                                                Administration 
                                                @elseif($bps[0]->categorie == 2)
                                                    {{App\Models\Fournisseur::firstWhere('id', $bps[0]->beneficiaire)->name}}
                                                @endif
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if ($bps)
                                        <td>Adresse: </td>
                                        <td style="border: 1px solid;text-align:center"><strong>{{$bps[0]->created_at->format('d/m/Y')}}</strong></td>
                                        @endif
                                    </tr>
                                    <tr>
                                       
                                        @if ($bps)
                                        <td>Description generale: </td>
                                        <td style="border: 1px solid;text-align:center"><strong>{{$bps[0]->comment}}</strong></td>
                                        @endif
                                    </tr>
                                </table><br>


                                <table style="border: 2px solid;width: 100%" cellpadding="2">
                                    <tr>Documents attaches: (SVP voir la liste des documents requis pour assistance)</tr>
                                        <tr><td><br></td></tr>
                                   <tr>
                                        <td>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td>Document Achat:</td>
                                                    <td style="border: 1px solid;text-align:center;width:55%;margin: 20px" ></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <tr>
                                                    <td>Avanve:</td>
                                                    <td style="border: 1px solid;text-align:center;width:45%"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr><td><br></td></tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%;text-align:left">
                                                <tr>
                                                    <td>Feuille de presence:</td>
                                                    <td style="border: 1px solid;text-align:center;width:50%"></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <tr>
                                                    <td>Autres:</td>
                                                    <td style="border: 1px solid;text-align:center;width:70%"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr><td><br></td></tr>
                                    <caption><strong>Note:</strong> SVP fourni la documentation complete pour eviter le delai de paiement elastique.</caption>
                                </table><br>

                                
                            </td>
                            

                            <td style="width: 50%;text-align:right;;">

                                <table style="width: 100%;text-align:right;border-spacing : 10px;">
                                    <tr>
                                        <td>N<sup>o</sup> Recepisse / Deboursement: </td>
                                        <td style="border: 1px solid;text-align:center"><strong></strong></td>
                                    </tr>
                                    <tr>
                                        @if ($bps)
                                        <td>N<sup>o</sup> Date: </td>
                                        <td style="border: 1px solid;text-align:center"><strong>{{$bps[0]->created_at->format('d/m/Y')}}</strong></td>
                                        @endif
                                    </tr>
                                    <tr>
                                       
                                        @if ($bps)
                                        <td>Date de paiement demande: </td>
                                        <td style="border: 1px solid;text-align:center"><strong>{{$bps[0]->dateP}}</strong></td>
                                        @endif
                                    </tr>
                                </table><br><br><br>



                                <table style="width: 95%;margin-left:5%">
                                    <tr>
                                        <td style="width: 50%">
                                            <table style="width: 100%;text-align:left">
                                                <tr>
                                                    @if ($bps)
                                                    <td style="text-align:center;">Paiement caisse:</td>
                                                    <td style="border: 1px solid;text-align:center;width:40%"><strong>
                                                        @if($bps[0]->type == 1)
                                                            x
                                                        @endif
                                                    </strong></td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="text-align:center;">Paiement banque:</td>
                                                    <td style="border: 1px solid;text-align:center;width:40%">
                                                        @if ($bps)
                                                        <strong>
                                                            @if($bps[0]->type == 2 || $bps[0]->type == 3)
                                                                x
                                                            @endif
                                                        </strong>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%">
                                                <br><tr>
                                                    @if ($bps)
                                                    <td style="text-align:center;">N<sup>o</sup> ID Nationale:</td>
                                                    <td style="border: 1px solid;text-align:center;width:40%"><strong></strong></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    @if ($bps)
                                                    <td style="text-align:center;">ID RCCM:</td>
                                                    <td style="border: 1px solid;text-align:center"><strong></strong></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    @if ($bps)
                                                    <td style="text-align:center;">ID PATENTE:</td>
                                                    <td style="border: 1px solid;text-align:center"><strong></strong></td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table style="width: 100%;text-align:right">
                                                <BR><tr>
                                                    <td style="text-align:center;">N<sup>o</sup> GSM :</td>
                                                    <td style="border: 1px solid;text-align:center;width:50%"><strong></strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table style="width: 95%;margin-left:5%">
                                    <tr>
                                        <td style="width: 20%;text-align:center">Paiement:</td>
                                        <td style="width: 80%;text-align:center">
                                            <table style="width: 100%;text-align:right">
                                                <tr>
                                                    <td style="text-align:center;">Transfert bancaire:</td>
                                                    <td style="border: 1px solid;text-align:center;width:20%">
                                                        @if ($bps)
                                                        <strong>
                                                            @if($bps[0]->type == 3)
                                                                x
                                                            @endif
                                                        </strong>
                                                        @endif
                                                    </td>

                                                    <td style="text-align:center;">Cheque:</td>
                                                    <td style="border: 1px solid;text-align:center;width:20%">
                                                        @if ($bps)
                                                        <strong>
                                                            @if($bps[0]->type == 2)
                                                                x
                                                            @endif
                                                        </strong>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                                <br>

                                <table style="border: 2px solid;width: 95%;margin-left:5%;text-align:left" cellpadding="2">
                                    <tr>
                                        <td>N<sup>o</sup> compte</td>
                                        <td style="border: 1px solid;width:70%">
                                            <strong>
                                            @if ($compte && !empty($compte[0]))
                                                {{$compte[0]->numero}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Intitulé compte</td>
                                        <td style="border: 1px solid">
                                            <strong>
                                            @if ($compte && !empty($compte[0]))
                                                {{$compte[0]->intitule}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nom de la Banque</td>
                                        <td style="border: 1px solid">
                                            <strong>
                                            @if ($compte && !empty($compte[0]))
                                                {{$compte[0]->banque}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Adresse Banque</td>
                                        <td style="border: 1px solid">
                                            <strong>
                                            @if ($compte && !empty($compte[0]))
                                                {{$compte[0]->adresse}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr><td><br></td></tr>
                                </table>
                            </td>


                         <table>

                                
                        </tr>
                    </table><br>


                    <table style="border: 2px solid;width: 100%;text-align:center">
                        <tr style="border: none;width: 100%;text-align:center">
                            <th style="border: 2px solid;text-align:center"><strong>Comptable</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>Designation Produit / Service / Travaux / [Marque, modele, donnees techniques, dimensions, poids]</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>Devise</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>Montant</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>Code Subvention/Projet</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>Compte principal</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>Sous compte</strong></th>
                            <th style="border: 2px solid;text-align:center"><strong>site/base</strong></th>
                            <th style="border: 2px solid;width:10%;text-align:center"><strong></strong></th>
                        </tr>
                        @if ($bps)
                            @if ($bps[0]->categorie == 2)
                                @foreach ($products as $prod)

                                    <tr style="border: 1px solid;width: 100%;text-align:center">
                                        <td></td>
                                        <td>{{App\Models\Article::firstWhere('id', $prod->produit)->marque.' '.App\Models\Article::firstWhere('id', $prod->produit)->model.' '.App\Models\Article::firstWhere('id', $prod->produit)->model}}</td>

                                        <td>USD</td>
                                        <td>{{ $prod->prix * App\Models\ProductOder::where('etatBes', $das[0]->eb)->where('description', $prod->produit)->get()[0]->quantite }}</td>

                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                @endforeach

                                <tr>
                                    <th><strong>Total</strong></th>
                                    <th></th>
                                    <th></th>
                                    <th><strong>$ {{$some}}</strong></th>
                                </tr>
                            @elseif($bps[0]->categorie == 4)
                                @foreach ($products as $prod)

                                    <tr style="border: 1px solid;width: 100%;text-align:center">
                                        <td></td>
                                        <td>{{ $prod->libelle}}</td>

                                        <td>USD</td>
                                        <td>{{ $prod->prix * $prod->quantite }}</td>

                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                @endforeach

                                <tr>
                                    <th><strong>Total</strong></th>
                                    <th></th>
                                    <th></th>
                                    <th><strong>$ {{$some}}</strong></th>
                                </tr>
                            @endif
                        @endif
                    </table><br>


                    <table style="border: 2px solid;width: 100%;text-align:center">
                        <tr style="border: none;width: 100%;text-align:center">
                            <th><strong>Demande par</strong></th>
                            @if ($bps)
                                @if($index[0]->projet != 1)
                                <th><strong>Verifie par</strong></th>
                                @endif
                            
                                <th><strong>Approuve par</strong></th>
                                @if($bps[0]->type != 1)
                                <th><strong>Autorise par</strong></th>
                                @endif
                            @endif
                        </tr>
                        <tr style="border: none;">

                            <td>
                                <span></span><br><br>
                                @if ($index)

                                    <p class="center">{{ App\Models\User::firstWhere('id', $index[0]->agent)->name}}<br>
                                    Le {{$index[0]->updated_at->format('d/m/Y')}}</p>
                                    <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $index[0]->agent)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                @endif
                            </td>

                            @if ($bps)
                                @if($index[0]->projet != 1)
                                    <td>
                                        <span></span><br><br>
                                        @if (isset($valid1[0]) && !empty($valid1[0]))

                                            <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                            Le {{$valid1[0]->updated_at->format('d/m/Y')}}</p>
                                            <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                        @endif
                                    </td>
                                    @endif
                                @endif

                            <td>
                                <span></span><br><br>
                                @if (isset($valid2[0]) && !empty($valid2[0]))

                                    <p class="center">{{ App\Models\User::firstWhere('id', $valid2[0]->user)->name}}<br>
                                    Le {{$valid2[0]->updated_at->format('d/m/Y')}}</p>
                                    <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid2[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                @endif
                            </td>
                            @if ($bps)
                                @if($bps[0]->type != 1)
                                <td>
                                    <span></span><br><br>
                                    @if (isset($valid3[0]) && !empty($valid3[0]))

                                        <p class="center">{{ App\Models\User::firstWhere('id', $valid3[0]->user)->name}}<br>
                                        Le {{$valid3[0]->updated_at->format('d/m/Y')}}</p>
                                        <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid3[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                    @endif
                                </td>
                                @endif
                            @endif
                        </tr>
                    </table>






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
                    <button class="btn btn-primary" onclick="imprimer('printBp')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>
