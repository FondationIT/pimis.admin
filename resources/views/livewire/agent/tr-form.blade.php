<div>
    <!-- Modal Etat de besion -->
 
     <div class="modal fade" id="trModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Terme de Reference</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                </div>
                <form id="registerTR" class="needs-validation" >
                    <div class="modal-body">
                        <div id="messageErrTR"></div>
    
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="projet">Nom de l'agent</label>
                                <input type="text" class="form-control"  readonly value="{{ Auth::user()->name }}" >
                                <input type="text" class="form-control" id="agentTR" hidden value="{{ Auth::user()->id }}" >
                            </div>
                            <div class="col-md-6 mb-10">
                                <label for="projet">Selectionner projet</label>
                                <select class="form-control select2" id="projetTR" onchange="afficheProjectChoix(this.value)">
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

                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label>Type TDR</label>
                                <select class="form-control select2" id="typeTR">
                                    <option value=""></option>
                                    <option value="1" selected>Mission</option>
                                    <option value="2">Autre</option>

                                </select>
                                <div class="invalid-feedback">
                                    Selectionner une option
                                </div>
                            </div>
                            <div class="col-md-8 mb-10">
                                
                                <label>Titre TDR</label>
                                <textarea class="form-control" id="titreTR" value="TDR"></textarea>
                                
                            </div>
                        </div>
                        {{-- Autres rows --}}
                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label>Objectif de la Mission</label>
                                <textarea class="form-control" id="obj_m" name="objectif" value="Objectif"></textarea>
                            </div>
                            <div class="col-md-8 mb-10">
                                
                                <label>Activite <i style="font-size: 0.8rem; color: #b48803;">&#9888; Pour chaque activité, utilisez « ; » pour la séparation.</i></label>
                                <textarea class="form-control" id="activite_m" name="activite" value="Activite"></textarea>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label>Equipe</label>
                                <div class="team-selector">
                                    <div class="selected-users" id="selectedUsers"></div>
                                    <div class="dropdown" id="dropdown">
                                        <input type="text" class="form-control" id="equipe" name='equipe' placeholder="Search by name or ID...">
                                        <ul id="userList"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-10">
                                
                                <label>Resultat Attendu</label>
                                <textarea class="form-control" id="rslt_m" name="resultat" value="Result"></textarea>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-10 mission-field">
                                <label for="startDate">Debut de la mission</label>
                                <input type="datetime-local" id="startDate" name="startDate" value="{{ date('Y-m-d\TH:i') }}">
                            </div>
                            <div class="col-md-6 mb-10 mission-field">
                                <label for="endDate">Fin de la mission</label>
                                <input type="datetime-local" id="endDate" name="endDate" value="{{ date('Y-m-d\TH:i') }}">
                            </div>
                            
                        </div>
                        

                        <hr>

                        <div class="form-row">
                            
                            <div class="col-md-5 mb-10">
                                <label for="product">Libellé</label>
                                <textarea class="form-control prodTR" name="product" value="Libelee"></textarea>
                            </div>

                            <div class="col-md-2 mb-10">
                                <label for="product">Unité</label>
                                <input type="texte" class="form-control uniteTR" name="unite" value="g">
                            </div>

                            <div class="col-md-2 mb-10">
                                <label for="username">Quantité</label>
                                
                                <input type="number" step="1" min="1" class="form-control QteTR" name="" value="1">
                            </div>

                            <div class="col-md-2 mb-10">
                                <label for="username">Prix U.</label>
                                
                            <input type="number" step="1" min="1" class="form-control prixTR" name="" value="1">
                            </div>
    
                            <div class="col-md-1 mb-10">
    
                            </div>
                        </div>
                        <div id="autreTR">
                        </div>
                        <a href="#" id="trAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a>
                        <hr>
    
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnTR" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldTR" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
             </div>
 
         </div>
     </div>
 </div>