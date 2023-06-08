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
                 <form id="registerEtBes" class="needs-validation" >
                 <div class="modal-body">
                     <div id="messageErrEtBes"></div>
 
                     <div class="form-row">
                         <div class="col-md-6 mb-10">
                             <label for="projet">Nom de l'agent</label>
                             <input type="text" class="form-control"  readonly value="{{ Auth::user()->name }}" >
                             <input type="text" class="form-control" id="agentEB" hidden value="{{ Auth::user()->id }}" >
                         </div>
                         <div class="col-md-6 mb-10">
                             <label for="projet">Selectionner projet</label>
                             <select class="form-control select2" id="projetEB" required>
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
                     <div class="form-row">
                         <div class="col-md-12 mb-10">
                             <label for="cat">Categorie de produit</label>
                             <select class="form-control select2" id="catEB" onchange="afficheCatChoix(this.value)" required>
                                 <option value=""></option>
 
                                 @foreach ($categories as $cat)
                                     <option value="{{$cat->id}}">{{$cat->name}}</option>
                                 @endforeach
                             </select>
                             <div class="invalid-feedback">
                                 Selectionner une option
                             </div>
                         </div>
                     </div>
                     <hr>
                     <div class="form-row">
                         <input type="text"  id="allProdPlus" hidden value='{"bad":{{json_encode($products)}} }' >
                         <div class="col-md-3 mb-10">
                             <label for="product">Produit</label>
                             <select class="form-control prodEB22" id="prodEB12" name="product" onchange="afficheEBChoix(this.value,1)" required>
 
                             </select>
                             <div class="invalid-feedback">
                                 Selectionner un produit
                             </div>
                         </div>
                         <div class="col-md-3 mb-10">
                             <label for="username">Quantité</label>
                             <div class="input-group">
                                 <input type="number" class="form-control QteEB12" name="username"  aria-describedby="inputGroupPrepend" required>
                                 <div class="input-group-prepend">
                                     <span class="input-group-text uniteC" id="unite-177"></span>
                                 </div>
                                 <div class="invalid-feedback">
                                     Le nom d'utilisateur est obligatoire
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-5 mb-10">
                             <label for="description">Aspects spécifiques</label>
                             <textarea class="form-control descEB1" name="description" id="prodE12"></textarea>
                         </div>
 
 
                         <div class="col-md-1 mb-10">
 
                         </div>
                     </div>
                     <div id="autreEB">
                     </div>
                     <a href="#" id="eBAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                     <hr>
                     <div class="form-row">
                         <div class="col-md-12 mb-10">
                             <label for="commentEB">Commentaire</label>
                             <textarea class="form-control" name="commentEB22" id="commentEB22"></textarea>
                         </div>
                     </div>
 
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-primary" id="btnEtBes" type="submit">Valider</button>
                     <div class="loader-pendulums" id="prldEtBes" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                 </div>
             </form>
             </div>
 
         </div>
     </div>
 </div>
 
