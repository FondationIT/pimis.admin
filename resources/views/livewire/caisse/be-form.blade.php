
<div>
    <!-- Modal Project -->
    <div class="modal fade" id="beModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
       <div class="modal-dialog " role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h6 class="modal-title">Bon d'entrée</h6>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
   
               <form wire:submit.prevent='submit'>
   
                   <div class="modal-body">
   
                       <div id="messageErrPojet"></div>
   
                       <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="bailleur">Agent *</label>
                            <select class="form-control select2 @error('agent') is-invalid @enderror" wire:model.defer="state.agent" name="agent">
                                <option value=""></option>

                                @foreach ($agent as $agent)
                                    <option value="{{$agent->id}}">{{$agent->firstname}} {{$agent->lastname}}  {{$agent->middlename}}</option>
                                @endforeach
                            </select>
                            @error('agent')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                       </div>

                       <div class="form-row">
                        <div class="col-md-12 mb-10">
                            <label for="bailleur">Projet *</label>
                            <select class="form-control select2 @error('projet') is-invalid @enderror" wire:model.defer="state.projet" name="projet" placeholder="">
                                <option value=""></option>

                                @foreach ($projet as $aff)
                                    <option value="{{$aff->id}}">{{$aff->name}}</option>
                                @endforeach
                            </select>
                            @error('projet')
                                <span class="text-red-600" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                       </div>


                       <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="int">Montant en chifre</label>
                                <input type="number" min="1" class="form-control @error('montant') is-invalid @enderror" wire:model.defer="state.montant" name="montant" required >
                                @error('montant')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="montantTL">Montant en Lettre</label>
                                <input type="texte" class="form-control @error('montantTL') is-invalid @enderror" wire:model.defer="state.montantTL" name="montantTL" >
                                @error('montantTL')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>





                       <div class="form-row">
                           <div class="col-md-12 mb-10">
                               <label for="contexte">Motif</label>
                               <div class="tinymce-wrap">
                                   <textarea class="form-control @error('motif') is-invalid @enderror" wire:model.defer="state.motif" name="motif"  ></textarea>
                                   @error('motif')
                                        <span class="text-red-600" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                               </div>
                           </div>
                       </div>
   
                   </div>
                   <div class="modal-footer">
                       <button class="btn btn-primary" wire:loading.attr='disabled' type="submit">Valider</button>
                   </div>
               </form>
           </div>
       </div>
    </div>
</div>