<div>

    <div class="modal fade" id="pEtBesModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Etat de besoin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="printBr">

                    <table class="tablePrt" border=1 bordercolor=#000000 align=center cellspacing=0 style="width: 100%;height:100%">

                        <!-- Création de l'entête à répéter -->
                        <thead>
                            <tr><td>

                                <table>
                                    <tr>
                                        <td style="width:80%;vertical-align: middle;">
                                            <h3>BON DE REQUISITION</h3>
                                                <p class="">N<sup>o</sup> : <b>@if ($ebs)
                                                    {{$ebs[0]->reference}}
                                                @endif</b></p>
                                        </td>
                                        <td style="text-align: right;float:right;"><livewire:layouts.print-header></td>
                                    </tr>
                                </table>

                                <hr>
                            </td></tr>
                        </thead>

                        <!-- Création du pied de page à répéter -->


                        <!-- corps du tableau -->
                        <tbody>
                            <tr><td>

                                <div class="row">
                                    @if ($ebs)
                                        <div class="col-lg-6" style="text-align: left">
                                            <p>Nom du demandeur : <strong>{{ App\Models\User::firstWhere('id', $ebs[0]->agent)->name}}</strong></p>
                                            <p>Projet du demandeur : <strong>{{ App\Models\Projet::firstWhere('id', $ebs[0]->projet)->name}}</strong></p>

                                        </div>
                                        <div class="col-lg-6 droite" style="text-align: right">
                                            <p>Categorie : <strong>{{ App\Models\Categorie::firstWhere('id', $ebs[0]->categorie)->name}}</strong></p>
                                            <p>Date : <strong>{{$ebs[0]->created_at->format('d/m/Y')}}</strong></p>
                                        </div>
                                    @endif

                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-lg-12" style="text-align: center">
                                        <table class="table table-striped table-border mb-0 prodT">
                                            <tr>
                                                <th><strong>N<sup>o</sup></strong></th><th><strong>Designation</strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>Detail</strong></th>
                                            </tr>
                                            @if ($products)
                                                @foreach ($products as $prod)
                                                    <tr>
                                                        <td>{{$i++}}</td><td>{{App\Models\Product::firstWhere('id', App\Models\Article::firstWhere('id', $prod->description)->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}} </td><td>{{$prod->quantite}}</td><td>{{ App\Models\Article::firstWhere('id', $prod->description)->unite}}</td><td>{{App\Models\Article::firstWhere('id', $prod->description)->description}}</td>
                                                    </tr>
                                                @endforeach

                                            @endif
                                        </table>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-lg-12" style="text-align: center">
                                        <table class="table table-striped table-border mb-0">
                                            <tr>
                                                <th><strong>Etabli par</strong></th><th><strong>Verifier par</strong></th><th><strong>Approuver par</strong></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>Agent</span><br><br>
                                                    @if (isset($ebs[0]) && !empty($ebs[0]))

                                                        <p class="center" >{{ App\Models\User::firstWhere('id', $ebs[0]->agent)->name}}<br>
                                                        Le {{$ebs[0]->created_at->format('d/m/Y')}}</p>
                                                        <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $ebs[0]->agent)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                                    @endif
                                                </td>

                                                <td>
                                                    <span>Comptable</span><br><br>
                                                    @if (isset($valid1[0]) && !empty($valid1[0]))

                                                        <p class="center">{{ App\Models\User::firstWhere('id', $valid1[0]->user)->name}}<br>
                                                        Le {{$valid1[0]->updated_at->format('d/m/Y')}}</p>
                                                        <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid1[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />

                                                    @endif
                                                </td>

                                                <td>
                                                    @if (isset($ebs[0]) && !empty($ebs[0]))
                                                        @if ($ebs[0]->projet == 3 || $ebs[0]->projet == 70 || $ebs[0]->projet == 71)
                                                            <span>Chef Comptable</span><br><br>
                                                            @if (isset($valid2[0]) && !empty($valid2[0]))
                                                                <p class="center">{{ App\Models\User::firstWhere('id', $valid2[0]->user)->name}}<br>
                                                                    Le {{$valid2[0]->updated_at->format('d/m/Y')}}
                                                                </p>
                                                                <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid2[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
                                                            @endif
                                                        @else
                                                            <span>Chef Projet</span><br><br>
                                                            @if (isset($valid2[0]) && !empty($valid2[0]))
                                                                <p class="center">{{ App\Models\User::firstWhere('id', $valid2[0]->user)->name}}<br>
                                                                    Le {{$valid2[0]->updated_at->format('d/m/Y')}}
                                                                </p>
                                                                <img class="signn" src="{{ asset('storage/'.App\Models\User::firstWhere('id', $valid2[0]->user)->signature)}}" style="position: relative;width:200px;text-align: center;margin:auto;margin-top:-80px;" />
                                                            @endif
                                                        @endif
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
                    <button class="btn btn-primary" onclick="imprimer('printBr')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
