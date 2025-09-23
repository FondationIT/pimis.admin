<div>
    <!-- Modal Etat de besion -->
 
     <div class="modal fade" id="contratAModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Contrat</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <form id="registerCtr" class="needs-validation" >
                 <div class="modal-body">
                     <div id="messageErrCTR"></div>
 
                     <div class="form-row">
                         <div class="col-md-6 mb-10">
                             <label>Selectionner agent</label>
                             <select class="form-control select2" id="agentCtr" required>
                                 <option value=""></option>
 
                                 @foreach ($agent as $ag)
                                     <option value="{{$ag->id}}">{{$ag->firstname}} {{$ag->lastname}} {{$ag->middlename}}</option>
                                 @endforeach
 
                             </select>
                         </div>
                         <div class="col-md-6 mb-10">
                            <label>Type de contrat</label>
                            <select class="form-control" id="typeCtr" required>
                                <option value=""></option>
                                <option value="1">CDD</option>
                                <option value="2">Consultance NI</option>
                                <option value="3">Consultance I</option>

                            </select>
                        </div>
                     </div>

                     <div class="form-row">
                        <div class="col-md-4 mb-10">
                            <label>Debut</label>
                            <input type="date" class="form-control" id="debutCtr" required>
                        </div>
                        <div class="col-md-4 mb-10">
                            <label>Fin</label>
                            <input type="date" class="form-control" id="finCtr" required>
                        </div>
                        <div class="col-md-4 mb-10">
                            <label for="username">Salaire</label>
                            

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend"><i>$/Mois</i></span>
                                </div>
                                <input type="number" step="1" min="1" class="form-control" id="salaireCtr" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label>Projet</label>
                            <select class="form-control select2" id="projet1Ctr" onchange="showPart(this)" required>
                                <option value=""></option>

                                @foreach ($projets as $ag)
                                    <option value="{{$ag->id}}">{{$ag->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="product">Autres details</label>
                            <input id="allProjetCtrPlus" value="{{$projet}}" hidden>
                            <input id="allProjetsCtrPlus" value="{{$projets}}" hidden>
                            <textarea class="form-control" id="descriptionCtr"></textarea>
                        </div>
                    </div>

                     <hr>
                     
                     <h5>Participation Projet</h5>
                     <div class="form-row">

                        
                         
                         <div class="col-md-5 mb-10">

                             <label>Selectionner projet</label>

                             <select class="form-control projetCtr" id="projetCtr1" readonly required>
                                 
                             </select>
                         </div>

                         <div class="col-md-4 mb-10">
                            <label>Participation</label>
                           
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i>%</i></span>
                            </div>
                            <input type="number" class="form-control partCtr" id="partCtr1" readonly required>
                           </div>
                        </div>
 
                         <div class="col-md-1 mb-10">
 
                         </div>
                     </div>
                     <div id="autreCTR">
                     </div>
                     <a href="#" id="ctrAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                     <hr>
 
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-primary" id="btnCTR" type="submit">Valider</button>
                     <div class="loader-pendulums" id="prldCTR" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                 </div>
             </form>
             </div>
 
         </div>
     </div>
 </div>