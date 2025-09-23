<div>

    <div class="modal fade" id="listePaieModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Liste de paie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printLp">

                    <table class="tablePrt" border=1 bordercolor=#000000 align=center cellspacing=0 style="width: 100%;height:100%">

                        <!-- Création de l'entête à répéter -->
                        <thead>
                            <tr><td>

                                <table>
                                    <tr>
                                        <td style="width:80%;vertical-align: middle;">
                                            <h3>LISTE DE PAIE</h3>
                                            <p>N<sup>o</sup> : <b>@if ($lp)
                                                {{$lp[0]->reference}}
                                            @endif</b></p>
                                        </td>
                                        <td style="text-align: right;float:right;"><livewire:layouts.print-header></td>
                                    </tr>
                                </table>

                                <hr>
                            </td></tr>
                        </thead>

                         <!-- corps du tableau -->
                        <tbody>
                            <tr><td>

                                <div class="row">
                                    @if ($lp)
                                        <div class="col-lg-4" style="text-align: left">
                                            <p>Mois : <strong>{{$lp[0]->month}}</strong></p>


                                        </div>

                                        <div class="col-lg-4" style="text-align: center">
                                            @if ($projet)
                                                <h6>Staff {{$projet[0]->name}}</h6>
                                            @else
                                                <h6>Tous les staff</h6>
                                            @endif
                                        </div>

                                        <div class="col-lg-4 droite" style="text-align: right">
                                            <p>Date : <strong>{{$lp[0]->created_at->format('d/m/Y')}}</strong></p>
                                        </div>
                                    @endif

                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-lg-12" style="text-align: left">
                                        @if ($lp)
                                            @if($lp[0]->type == 1)
                                            <table class="table table-striped table-border mb-0" style="padding: 5px;">
                                                <tr style="font-size:11px">
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    @else
                                                    <th><strong>Projet</strong></th>
                                                    @endif
                                                    <th><strong>Nom complet</strong></th>
                                                    <th><strong>Jrs_P</strong></th>
                                                    <th><strong>Efts</strong></th>
                                                    <th><strong>S_Base</strong></th>
                                                    <th><strong>T.B.I</strong></th>
                                                    <th><strong>IPR</strong></th>
                                                    <th><strong>QPO</strong></th>
                                                    <th><strong>QPP</strong></th>
                                                    <th><strong>ONEM</strong></th>
                                                    <th><strong>INPP</strong></th>
                                                    <th><strong>Net_P</strong></th>
                                                    <th><strong>Charge_P</strong></th>
                                                    <th><strong>T.C</strong></th>
                                                    <th><strong>S_Brut</strong></th>
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    <th><strong>A_Payer</strong></th>
                                                    @endif
                                                </tr>
                                                @if ($agents)
                                                    @foreach ($agents as $prod)

                                                    <?php
                                                        $taux =App\Models\Taux::firstWhere('id', $lp[0]->taux)->taux;
                                                        $sb = ((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130;
                                                        $qpo = $sb*5/100;
                                                        $tbi = (sprintf("%.2f", (((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130)-((((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130)*5/100)));

                                                        $qpp = $sb*13/100;
                                                        $inpp = $sb*1/100;
                                                        $onem = $sb*0.2/100;

                                                        $cp = $sb*14.2/100;

                                                        $tbi_fc = $tbi*$taux;
                                                        $ind_t = (10000*$prod->jp)/$taux;
                                                        $all_f = ($prod->ne*455.62*$prod->jp)/$taux;
                                                        $av = $ind_t + $all_f;
                                                        $ipr_max = ($tbi_fc*30/100)/$taux;
                                                        $ipr_form = 0;
                                                        $ipr_cal = 0;
                                                        $ipr_ret = 0;

                                                        if($tbi_fc<= 162000){
                                                            $ipr_form = ($tbi_fc*3/100)/$taux;
                                                        }
                                                        if($tbi_fc > 162000 ){
                                                            $i1 = 162000*3/100;
                                                            $a = $tbi_fc-162000;

                                                            if($a <= 1800000){
                                                                $i2 = $a*15/100;
                                                                $ipr_form = ($i1+$i2)/$taux;
                                                            }

                                                            if($a > 1800000 ){


                                                                $b = $a-1638000;

                                                                if($b <= 3600000){

                                                                    $i1 = 162000*3/100;
                                                                    $i2 = 1638000*15/100;
                                                                    $i3 = $b*30/100;

                                                                    $ipr_form = ($i1+$i2+$i3)/$taux;
                                                                }

                                                                if($b > 3600000){

                                                                    $c = $b-1800000;
                                                                    $i1 = 162000*3/100;
                                                                    $i2 = 1638000*15/100;
                                                                    $i3 = 1800000*30/100;
                                                                    $i4 = $c*40/100;

                                                                    $ipr_form = ($i1+$i2+$i3+$i4)/$taux;
                                                                }


                                                            }

                                                        }

                                                        $et_civ = App\Models\StatutAgent::firstWhere('id', $prod->sAgent)->etatcivil;

                                                        if($et_civ == 'Marie(e)'){
                                                            $pers_ch = $prod->ne+1;
                                                        }else{
                                                            $pers_ch = $prod->ne;
                                                        }

                                                        if($pers_ch > 9){
                                                            $pers_ch = 9;
                                                        }

                                                        if($tbi_fc <= 1159000){
                                                            $ipr_cal = $ipr_form - ($pers_ch*$ipr_form*2/100);
                                                        }else{
                                                            $ipr_cal = $ipr_form;
                                                        }

                                                        if($ipr_cal > $ipr_max){
                                                            $ipr_ret = $ipr_max;
                                                        }else{
                                                            $ipr_ret = $ipr_cal;
                                                        }
                                                        $net_p = ($prod->SB-$ipr_ret-$qpo);
                                                        $brut = $net_p + $cp +$qpo +$ipr_ret;
                                                        if(Auth::user()->role == 'COMPT2'){
                                                        $prt = $projet[0]->id;

                                                        if($prt == 3){
                                                            $pourc = App\Models\PartContrat::where('contrat', $prod->contrat)->where('projet',$prt)->get()[0]->pourcentage;
                                                            $ap = $brut*$pourc/100;
                                                            $some +=$ap;
                                                        }else{
                                                            $ap = $brut;
                                                            $some +=$brut;
                                                        }
                                                        }else{
                                                            $some +=$brut;
                                                        }



                                                    ?>
                                                        <tr style="text-align:left;font-size:10px">


                                                            @if (Auth::user()->role == 'COMPT2')
                                                            @else
                                                            <td>{{App\Models\Projet::firstWhere('id', App\Models\Contrat::where('agent', $prod->agent)->where('statut',true)->where('active',true)->get()[0]->projet)->name}}</td>
                                                            @endif

                                                            <td>{{App\Models\Agent::firstWhere('id', $prod->agent)->firstname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->lastname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->middlename}}</td>

                                                            <td>{{$prod->jp}}</td>
                                                            <td>{{$prod->ne}}</td>
                                                            <td>${{(sprintf("%.2f", $sb))}}</td>
                                                            <td>${{(sprintf("%.2f", $tbi))}}</td>
                                                            <td>${{(sprintf("%.2f", $ipr_ret))}}</td>
                                                            <td>${{(sprintf("%.2f", $qpo))}}</td>
                                                            <td>${{sprintf("%.2f", $qpp)}}</td>
                                                            <td>${{sprintf("%.2f", $onem)}}</td>
                                                            <td>${{sprintf("%.2f", $inpp)}}</td>
                                                            <td style="color: #528FEB">${{sprintf("%.2f", $net_p)}}</td>
                                                            <td>${{sprintf("%.2f", $cp)}}</td>
                                                            <td style="color: peru"><strong>${{sprintf("%.2f", $brut)}}</strong></td>
                                                            <td><strong>${{sprintf("%.2f", $prod->SB)}}</strong></td>
                                                            @if (Auth::user()->role == 'COMPT2')
                                                            <td style="color: peru"><strong>${{sprintf("%.2f", $ap)}}</strong></td>
                                                            @endif

                                                        </tr>
                                                    @endforeach

                                                @endif
                                                <tr>
                                                    <th><strong>Total</strong></th>
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    @else
                                                    <th></th>
                                                    @endif
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    <th></th>
                                                    <th><span class="badge badge-info">${{sprintf("%.2f", $some)}}</span></th>
                                                    @else
                                                    <th><span class="badge badge-info">${{sprintf("%.2f", $some)}}</span></th>
                                                    @endif
                                                </tr>
                                            </table>

                                            @else






                                            <table class="table table-striped table-border mb-0" style="padding: 5px;">
                                                <tr style="font-size:11px">
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    @else
                                                    <th><strong>Projet</strong></th>
                                                    @endif
                                                    <th><strong>Nom</strong></th>
                                                    <th><strong>S_Brut</strong></th>
                                                    <th><strong>S_Base</strong></th>
                                                    <th><strong>IPR_Ret</strong></th>
                                                    <th><strong>Net_P</strong></th>
                                                    <th><strong>T.C</strong></th>
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    <th><strong>A_Payer</strong></th>
                                                    @endif
                                                </tr>
                                                @if ($agents)
                                                    @foreach ($agents as $prod)

                                                    <?php
                                                        $taux =App\Models\Taux::firstWhere('id', $lp[0]->taux)->taux;
                                                        $sb = $prod->SB;

                                                        if($prod->type == 3){
                                                            $ipr_ret = $prod->SB*15/100;
                                                        }else {
                                                            $ipr_ret = 0;
                                                        }



                                                        $net_p = ($prod->SB-$ipr_ret);
                                                        $brut = $net_p +$ipr_ret;
                                                        if(Auth::user()->role == 'COMPT2'){
                                                        $prt = $projet[0]->id;

                                                        if($prt == 3){
                                                            $pourc = App\Models\PartContrat::where('contrat', $prod->contrat)->where('projet',$prt)->get()[0]->pourcentage;
                                                            $ap = $brut*$pourc/100;
                                                            $some +=$ap;
                                                        }else{
                                                            $ap = $brut;
                                                            $some +=$brut;
                                                        }
                                                        }else{
                                                            $some +=$brut;
                                                        }



                                                    ?>
                                                        <tr style="text-align:left;font-size:10px">

                                                            @if (Auth::user()->role == 'COMPT2')
                                                            @else
                                                            <td>{{App\Models\Projet::firstWhere('id', App\Models\Contrat::where('agent', $prod->agent)->where('statut',true)->where('active',true)->get()[0]->projet)->name}}</td>
                                                            @endif

                                                            <td>{{App\Models\Agent::firstWhere('id', $prod->agent)->firstname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->lastname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->middlename}}</td>

                                                            <td><strong>${{sprintf("%.2f", $prod->SB)}}</strong></td>

                                                            <td>${{(sprintf("%.2f", $sb))}}</td>
                                                            <td>${{sprintf("%.2f", $ipr_ret)}}</td>
                                                            <td style="color: #528FEB">${{sprintf("%.2f", $net_p)}}</td>
                                                            <td style="color: peru"><strong>${{sprintf("%.2f", $brut)}}</strong></td>
                                                            @if (Auth::user()->role == 'COMPT2')
                                                            <td style="color: peru"><strong>${{sprintf("%.2f", $ap)}}</strong></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach

                                                @endif
                                                <tr>
                                                    <th><strong>Total</strong></th>
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    @else
                                                    <th></th>
                                                    @endif
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    @if (Auth::user()->role == 'COMPT2')
                                                    <th></th>
                                                    <th><span class="badge badge-info">${{sprintf("%.2f", $some)}}</span></th>
                                                    @else
                                                    <th><span class="badge badge-info">${{sprintf("%.2f", $some)}}</span></th>
                                                    @endif
                                                </tr>
                                            </table>


                                            @endif
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-lg-12" style="text-align: center">
                                        <table class="table table-striped table-border mb-0">
                                            <tr>
                                                <th><strong>Preparé par</strong></th><th><strong>Verifié par</strong></th><th><strong>Validé par</strong></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>R.H</span><br><br>
                                                    @if (isset($lp[0]) && !empty($lp[0]))

                                                        <p class="center" >{{ App\Models\User::firstWhere('id', $lp[0]->signature)->name}}<br>
                                                        Le {{$lp[0]->created_at->format('d/m/Y')}}</p>
                                                        <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $lp[0]->signature)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                                    @endif
                                                </td>


                                                <td>
                                                    <span>Chef Comptable</span><br><br>
                                                    @if (isset($valid1[0]) && !empty($valid1[0]))
                                                        <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                                            Le {{$valid1[0]->updated_at->format('d/m/Y')}}
                                                        </p>
                                                        <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
                                                    @endif
                                                </td>


                                                <td>
                                                    <span>D.A.F</span><br><br>
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

                            </td></tr>
                        </tbody>


                        <tfoot>
                            <tr>
                                <th><livewire:layouts.print-footer><th>
                            </tr>
                        </tfoot>


                    </table>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="imprimer('printLp')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>


