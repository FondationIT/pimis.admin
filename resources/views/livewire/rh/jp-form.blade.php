<div>
    <!-- Modal Affectation -->
    <div class="modal fade" id="jpAModalForms" tabindex="-1" wire:ignore.self role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Nouvel Paiement mois de </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form  id="registerJp" class="needs-validation" >
                  <div class="modal-body">
                    <div id="messageErrJP"></div>

                    @if ($paie)  
                    <input type="text" id="pymtJP"  value="{{$paie[0]->id}}" hidden >
                    @endif

                    <div class="col-sm">
                        <div class="table-wrap">
                            <div class="table-responsive" >
                                <table class="table  table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Jr preste</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contrat as $prod)
                                            <tr>

                                                <td>{{App\Models\Agent::firstWhere('id', $prod->agent)->firstname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->lastname}} {{App\Models\Agent::firstWhere('id', $prod->agent)->middlename}}</td>
                                                <td>
                                                    
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">Jr</span>
                                                        </div>
                                                        <input type="number" id="jp" min="0" class="form-control jourJP">
                                                        

                                                        <input type="text" id="agentP" class="agentJP"  value="{{$prod->agent}}" hidden >

                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" id="btnJP" type="submit">Valider</button>
                    <div class="loader-pendulums" id="prldJP" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
