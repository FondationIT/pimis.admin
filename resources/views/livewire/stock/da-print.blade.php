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

                    <div class="row">
                        @if ($ebs)
                            <div class="col-lg-12" style="text-align: left">
                                <p>Nom du demandeur : <strong>{{ App\Models\User::firstWhere('id', $ebs[0]->agent)->name}}</strong></p>
                                <p>Projet du demandeur : <strong>{{ App\Models\Projet::firstWhere('id', $ebs[0]->projet)->name}}</strong></p>
                                <p>Date : <strong>{{$ebs[0]->created_at->format('d/m/Y')}}</strong></p>
                                <p>Ligne bidgetaire (Ppale/Sec) : </p>
                            </div>
                        @endif

                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-lg-12" style="text-align: center">
                            <table class="table table-striped table-border mb-0">
                                <tr>
                                    <th><strong>N<sup>o</sup></strong></th><th><strong>Qte</strong></th><th><strong>Unite</strong></th><th><strong>Designation</strong></th><th><strong>Detail</strong></th>
                                </tr>
                                @if ($products)
                                    @foreach ($products as $prod)
                                        <tr>
                                            <td>{{$i++}}</td><td>{{$prod->quantite}}</td><td>{{ App\Models\Product::firstWhere('id', $prod->product)->unite}}</td><td>{{App\Models\Product::firstWhere('id', $prod->product)->designation}}</td><td>{{$prod->description}}</td>
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
                                        @if ($ebs)
                                            <p class="center">{{ App\Models\User::firstWhere('id', $ebs[0]->agent)->name}}</p><br><br><br><br>
                                            <p class="center">Le {{$ebs[0]->created_at->format('d/m/Y')}}</p>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($ebs)
                                            <p class="center">Le Comptable</p><br><br><br><br>
                                            <p class="center">Le {{$ebs[0]->updated_at->format('d/m/Y')}}</p>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($ebs)
                                            <p class="center">Le Chef projet</p><br><br><br><br>
                                            <p class="center">Le {{$ebs[0]->updated_at->format('d/m/Y')}}</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="imprimer('printDa')"><i class="icon-printer txt-danger"></i></button>
                </div>
            </div>

        </div>
    </div>


</div>
