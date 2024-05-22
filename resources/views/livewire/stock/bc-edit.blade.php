<div>
    <div class="modal fade" id="bcEditModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editer bons commande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    <div class="modal-body">

                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proforma as $prod)
                                                <tr>

                                                    <td>{{App\Models\Fournisseur::firstWhere('id', App\Models\Proforma::firstWhere('id', $prod->proforma)->fournisseur)->name}} </td>
                                                    
                                                    
                                                    <td>

                                                        @if (App\Models\Bc::where('da', $da[0]->id)->where('proforma', $prod->proforma)->exists())
                                                            <span class="badge badge-success">Terminer</span>
                                                        @else
                                                            <a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded"  wire:click="formBC({{$da}},{{$prod->proforma}})" data-toggle="modal" data-target="#bcModalForms"><span class="badge badge-info">Faire un BC</span></a>
                                                        @endif
                                                        
                                                        
                                                    </td>
                                                   

                                                </tr>

                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
            </div>

        </div>
    </div>
</div>
