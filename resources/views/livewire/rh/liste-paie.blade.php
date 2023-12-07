<div>

    <div class="modal fade" id="listePaieModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terme de reference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printLp">
                    <div class="row">

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logoN.png" style="width: 200px;position: relative;text-align: center" />
                        </div>

                        <div class="col-lg-6 fix" style="text-align: center">
                            <div>
                                <br>
                                <h3>LISTE DE PAIE</h3>
                                <p class="center">N<sup>o</sup> : <b>@if ($lp)
                                    {{$lp[0]->reference}}
                                @endif</b></p>
                            </div>
                        </div>

                        <div class="col-lg-3 fix" style="text-align: center">
                            <img src="img/logo/logoN.png" class="droite" style="width: 200px;position: relative;text-align: center" />
                        </div>
                    </div>

                    <hr class="mbtm" style="color:  #528FEB">

                    <div class="row">
                        @if ($lp)
                            <div class="col-lg-6" style="text-align: left">
                                <p>Mois : <strong>{{$lp[0]->month}}</strong></p>
                                
                                
                            </div>
                            <div class="col-lg-6 droite" style="text-align: right">
                                <p>Date : <strong>{{$lp[0]->created_at->format('d/m/Y')}}</strong></p>
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            
                            <table class="table table-striped table-border mb-0" style="padding: 5px;">
                                <tr style="font-size:11px">
                                    <th><strong>Projet</strong></th>
                                    <th><strong>Nom</strong></th>
                                    <th><strong>S_Brut</strong></th>
                                    <th><strong>Jrs_P</strong></th>
                                    <th><strong>Efts</strong></th>
                                    <th><strong>All_F</strong></th>
                                    <th><strong>Idm_T</strong></th>
                                    <th><strong>S_Base</strong></th>
                                    <th><strong>QPO</strong></th>
                                    <th><strong>T.B.I</strong></th>
                                    <th><strong>IPR_Max</strong></th>
                                    <th><strong>IPR_Form</strong></th>
                                    <th><strong>IPR_Cal</strong></th>
                                    <th><strong>IPR_Ret</strong></th>
                                    <th><strong>Net_P</strong></th>
                                    <th><strong>Charge_P</strong></th>
                                    <th><strong>Brut</strong></th>
                                </tr>
                                @if ($agents)
                                    @foreach ($agents as $prod)

                                    <?php
                                        $taux =App\Models\Taux::firstWhere('id', $lp[0]->taux)->taux;
                                        $tbi = (sprintf("%.2f", (((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130)-((((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130)*5/100)));
                                        
                                         $cp = $prod->SB*16.2/100;

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

                                                $i1 = 162000*3/100;
                                                $i2 = 1800000*15/100;
                                                $b = $a-1800000;

                                                if($b <= 3600000){
                                                    $i3 = $b*30/100;
                                                    $ipr_form = ($i1+$i2+$i3)/$taux;
                                                }

                                                if($b > 3600000 ){

                                                    $i1 = 162000*3/100;
                                                    $i2 = 1800000*15/100;
                                                    $i3 = 3600000*30/100;
                                                    $c = $b-3600000;
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

                                         $ipr_cal = $ipr_form - ($pers_ch*$ipr_form*2/100);

                                         if($ipr_cal > $ipr_max){
                                            $ipr_ret = $ipr_max;
                                         }else{
                                            $ipr_ret = $ipr_cal;
                                         }
                                         $net_p = ($tbi-$ipr_ret) + $av;
                                         $brut = $net_p + $cp
                                    ?>
                                        <tr style="text-align:left;font-size:10px">
                                           
                                            <td>{{App\Models\Projet::firstWhere('id', App\Models\Contrat::where('agent', $prod->agent)->where('statut',true)->where('active',true)->get()[0]->projet)->name}}</td>

                                            <td>{{App\Models\Agent::firstWhere('id', $prod->agent)->firstname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->lastname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->middlename}}</td>
                                            
                                            <td><strong>${{sprintf("%.2f", $prod->SB)}}</strong></td>
                                            
                                            <td>{{$prod->jp}}</td>
                                            <td>{{$prod->ne}}</td>
                                            <td>${{(sprintf("%.2f", $all_f))}}</td>
                                            <td>${{(sprintf("%.2f", $ind_t))}}</td>
                                            <td>${{(sprintf("%.2f", ((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/2500)+((10000*$prod->jp)/$taux))*100)/130))}}</td>
                                            <td>${{(sprintf("%.2f", (((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/2500)+((10000*$prod->jp)/$taux))*100)/130)*5/100))}}</td>
                                            <td>${{$tbi}}</td>
                                            <td>${{sprintf("%.2f", $ipr_max)}}</td>
                                            <td>${{sprintf("%.2f", $ipr_form)}}</td>
                                            <td>${{sprintf("%.2f", $ipr_cal)}}</td>
                                            <td>${{sprintf("%.2f", $ipr_ret)}}</td>
                                            <td style="color: #528FEB">${{sprintf("%.2f", $net_p)}}</td>
                                            <td>${{sprintf("%.2f", $cp)}}</td>
                                            <td style="color: peru"><strong>${{sprintf("%.2f", $brut)}}</strong></td>
                                        </tr>
                                    @endforeach

                                @endif
                                <tr>
                                    <th><strong>Total</strong></th>
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><strong>$</strong></th>
                                </tr>
                            </table>

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


                    <footer >
                        <hr style="color: #F5BF60">
                        <p style="text-align: center">
                            
                            <a href="panzi.org" style="text-align: center">panzi.org</a>
                            <span style="text-align: right;float:right">Par <strong>{{Auth::user()->name}}</strong></span>

                        </p>
                    </footer>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="imprimer('printLp')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>


