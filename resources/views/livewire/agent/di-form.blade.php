<div>
    <!-- Modal Etat de besion -->
 
     <div class="modal fade" id="diModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Demmande interne</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <form id="registerDI" class="needs-validation" >
                 <div class="modal-body">
                     <div id="messageErrDI"></div>
 
                     <div class="form-row">
                         <div class="col-md-6 mb-10">
                             <label for="projet">Nom de l'agent</label>
                             <input type="text" class="form-control"  readonly value="{{ Auth::user()->name }}" >
                             <input type="text" class="form-control" id="agentDI" hidden value="{{ Auth::user()->id }}" >
                         </div>
                         <div class="col-md-6 mb-10">
                             <label for="projet">Selectionner projet</label>
                             <select class="form-control select2" id="projetDI" onchange="afficheProjectChoix(this.value)" required>
                                 <option value=""></option>
 
                                 @foreach ($affectation as $aff)
                                     <option value="{{$aff->projet}}">{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</option>
                                 @endforeach
 
                             </select>
                             <div class="invalid-feedback">
                                 Selectionner une option
                             </div>
                         </div>
                     </div>
                     <hr>

                     <div class="form-row">
                         <input type="text"  id="allProdPlus2" hidden value='{"bad":{{json_encode($products)}} }' >
                         <input type="text"  id="allArtPlus2" hidden value='{"bad":{{json_encode($articles)}} }' >
                         <div class="col-md-7 mb-10">
                             <label for="product">Produit</label>
                             <select class="form-control prodDI" id="prodDI1" name="product" onchange="afficheDIChoix(this.value,1)" required>
 
                             </select>
                             <div class="invalid-feedback">
                                 Selectionner un produit
                             </div>
                         </div>
                         <div class="col-md-4 mb-10">
                             <label for="username">Quantité</label>
                             <div class="input-group">
                                 <input type="number" class="form-control QteDI" name="username"  aria-describedby="inputGroupPrepend" required>
                                 <div class="input-group-prepend">
                                     <span class="input-group-text uniteDI" id="uniteDI-1"></span>
                                 </div>
                                 <div class="invalid-feedback">
                                     Le nom d'utilisateur est obligatoire
                                 </div>
                             </div>
                         </div>
 
                         <div class="col-md-1 mb-10">
 
                         </div>
                     </div>
                     <div id="autreDI">
                     </div>
                     <a href="#" id="diAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                     <hr>
 
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-primary" id="btnDI" type="submit">Valider</button>
                     <div class="loader-pendulums" id="prldDI" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                 </div>
             </form>
             </div>
 
         </div>
     </div>
 </div>
 
