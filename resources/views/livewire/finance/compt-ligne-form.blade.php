<div>
    <div class="modal fade" id="appEtBesModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ligne par article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">
                        <div id="messageErrBoooo"></div>

                        
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                @if ($type == 1)
                                                <th>Produit</th> 
                                                @elseif ($type == 2)
                                                <th>Libellé</th> 
                                                @endif
                                                
                                                <th>Qte</th>
                                                <th>Unite</th>
                                                <th>Ligne</th>
                                                <th>Btn</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $prod)
                                                <tr>
                                                    @if ($type == 1)

                                                        <td>{{App\Models\Product::firstWhere('id', $prod->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}} {{App\Models\Article::firstWhere('id', $prod->description)->description}}</td>

                                                        <td>{{$prod->quantite}}</td>

                                                        <td>{{App\Models\Article::firstWhere('id', $prod->description)->unite}}</td>

                                                        <td>
                                                            <input type="text"  id="prixBr"  value= "{{$prod->ligne}}" class="form-control qteBr" required>
                                                            
                                                        </td>
                                                        <td>
                                                            <a href="#" class="p-1 text-teal-600 hover:bg-teal-600"  data-toggle="modal" data-target="#ligneArtModalForms"  rounded wire:click="ligneArt({{$prod->id}})" data-toggle="modal" data-target="">Ajouter</a>  
                                                        </td>

                                                    @elseif ($type == 2)
                                                    
                                                        <td>{{$prod->libelle}}</td>

                                                        <td>{{$prod->quantite}}</td>

                                                        <td>{{$prod->unite}}</td>

                                                        <td>
                                                            <input type="text"  id="prixBr"  value= "{{$prod->ligne}}" class="form-control qteBr" required>
                                                            
                                                        </td>
                                                        <td>
                                                            <a href="#" class="p-1 text-teal-600 hover:bg-teal-600"  data-toggle="modal" data-target="#ligneArtModalForms"  rounded wire:click="ligneTr({{$prod->id}})" data-toggle="modal" data-target="">Ajouter</a>  
                                                        </td>

                                                    @endif
 
                                                    
                                                  
                                                    
                                                    

                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        @if (Auth::user()->role == 'D.A.F')
                        @else
                        <button class="btn btn-primary" wire:loading.attr='disabled' type="submit">Approuver</button>
                        <div class="loader-pendulums" id="prldBr" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
