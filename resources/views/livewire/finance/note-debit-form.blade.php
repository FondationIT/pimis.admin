<div>
    <!-- Modal Etat de besion -->
 
     <div class="modal fade" id="ndModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Notes de debit</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <form id="registerND" class="needs-validation" >
                 <div class="modal-body">
                     <div id="messageErrND"></div>
 
                     <div class="form-row">
                         <div class="col-md-6 mb-10">
                             <label for="projet">Nom de l'agent</label>
                             <input type="text" class="form-control"  readonly value="{{ Auth::user()->name }}" >
                             <input type="text" class="form-control" id="agentND" hidden value="{{ Auth::user()->id }}" >
                         </div>
                         <div class="col-md-6 mb-10">
                             <label for="projet">Selectionner projet</label>
                             <select class="form-control select2" id="projetND" onchange="afficheProjectChoix(this.value)" required>
                                 <option value=""></option>
 
                                 @foreach ($projet as $projet)
                                     <option value="{{$projet->id}}">{{$projet->name}}</option>
                                 @endforeach
 
                             </select>
                             <div class="invalid-feedback">
                                 Selectionner une option
                             </div>
                         </div>
                     </div>
                     <hr>

                     <div class="form-row">
                         
                         <div class="col-md-5 mb-10">
                             <label for="product">Libellé</label>
                             <textarea class="form-control prodND" name="product" required></textarea>
                         </div>

                         <div class="col-md-2 mb-10">
                            <label for="product">Unité</label>
                            <input type="texte" class="form-control uniteND" name="unite" required>
                        </div>

                         <div class="col-md-2 mb-10">
                             <label for="username">Quantité</label>
                             
                            <input type="number" step="1" min="1" class="form-control QteND" name="" required>
                         </div>

                         <div class="col-md-2 mb-10">
                            <label for="username">Prix U.</label>
                            
                           <input type="number" step="1" min="1" class="form-control prixND" name="" required>
                        </div>
 
                         <div class="col-md-1 mb-10">
 
                         </div>
                     </div>
                     <div id="autreND">
                     </div>
                     <a href="#" id="ndAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                     <hr>
 
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-primary" id="btnND" type="submit">Valider</button>
                     <div class="loader-pendulums" id="prldND" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                 </div>
             </form>
             </div>
 
         </div>
     </div>
 </div>
 

