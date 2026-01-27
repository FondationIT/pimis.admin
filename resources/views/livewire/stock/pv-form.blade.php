<div>
    <div class="modal fade" id="pvModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="registerPv" class="needs-validation">
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erreur :</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div id="messageErrPv"></div>
                        
                        <div class="form-row">
                            <div class="col-md-4 mb-10">
                                <label for="description">Reference DA</label>
                                @if ($da)
                                <input type="text" class="form-control" value="{{$da[0]->reference}}" readonly>
                                <input type="text" id="daPv" class="form-control" value="{{$da[0]->id}}" hidden>
                                @endif

                            </div>
                            @if ($bailleur)
                                @if ($bailleur[0]->min1 <= $some && $some <= $bailleur[0]->max1)
                                <input type="text" id="titrePv" class="form-control" value="Achat directe" hidden>
                                @else
                                    <div class="col-md-8 mb-10">
                                        <label>Titre PV</label>
                                        <input type="text" class="form-control" id="titrePv" required>

                                    </div>
                                @endif
                            @endif
                        </div>
                        <hr>
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive" >
                                    <table class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qte</th>
                                                @foreach ($proforma as $prof)
                                                <th>{{App\Models\Fournisseur::firstWhere('id', $prof->fournisseur)->name}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $prod)
                                                <tr>

                                                    <td>{{App\Models\Product::firstWhere('id', App\Models\Article::firstWhere('id', $prod->description)->product)->name}} {{App\Models\Article::firstWhere('id', $prod->description)->marque}} {{App\Models\Article::firstWhere('id', $prod->description)->model}}</td>
                                                    <td>{{$prod->quantite}} {{App\Models\Article::firstWhere('id', $prod->description)->unite}}</td>
                                                    @foreach ($proforma as $prof)
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend">$</span>
                                                            </div>
                                                            <input type="number" id="PrixPv" step=.00001 min=0 class="form-control PrixPv" required>
                                                            

                                                            <input type="text" id="profPv" class="profPv"  value="{{$prof->id}}" hidden>
                                                            <input type="text" id="prodPv" class="prodPv" value="{{$prod->description}}" hidden>

                                                        </div>
                                                    </td>
                                                    @endforeach

                                                </tr>

                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <input id="allPartPVPlus" value="{{$agents}}" hidden>
                        @if ($bailleur)
                            @if ($bailleur[0]->min1 <= $some && $some <= $bailleur[0]->max1)
                            <input  class="form-control" id="datePv" value=""  hidden>
                            <input  class="form-control" id="obsPv" value="" hidden>
                            <input  class="form-control" id="typePv" value="1" hidden>
                            <input  class="form-control" id="fournPartPV" value="" hidden>
                            @else

                                 @if ($bailleur[0]->min2 <= $some && $some <= $bailleur[0]->max1)
                                    <input class="form-control" id="typePv" value="2" hidden>
                                 @else
                                    <input class="form-control" id="typePv" value="3" hidden>
                                 @endif
                                <hr>
                                <div class="form-row">

                                    <div class="col-md-6 mb-10">
                                        <label>Date de cloture</label>
                                        <input type="date" class="form-control" id="datePv" required>
                                    </div>
                                    
                                    
                                    <div class="col-md-6 mb-10">
                                        <label>Observation</label>
                                        <textarea type="" class="form-control" id="obsPv" required></textarea>
                                    </div>
                                </div><hr>

                                <div class="form-row">
                                    <div class="col-md-3 mb-10">

                                    </div>

                                    {{-- <div class="col-md-6 mb-10">
                                        <label>Les participants</label>
                                        <select class="form-control fournPartPV" id="agPv1" required>
                                            <option value=""></option>
                                            @foreach ($agents as $agent)
                                                <option value="{{$agent->id}}">{{$agent->firstname.' '.$agent->lastname}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}


                                    <div class="col-12 mb-3">
                                        <label class="form-label">Les participants</label>

                                        <div class="multi-select">
                                            <button type="button" class="form-control w-100 text-start" id="toggleDropdown">
                                                Sélectionner les participants
                                            </button>

                                            <div class="multi-select-dropdown w-100" id="agentDropdown">
                                                @foreach ($agents as $agent)
                                                    <label class="dropdown-item">
                                                        <input type="checkbox"
                                                            class="agent-checkbox"
                                                            value="{{ $agent->id }}"
                                                            data-name="{{ $agent->firstname.' '.$agent->lastname }}">
                                                        {{ $agent->firstname.' '.$agent->lastname }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Participants sélectionnés</label>
                                        <div id="selectedAgents" class="selected-box w-100"></div>
                                    </div>

                                    <script>
                                        const toggleBtn = document.getElementById('toggleDropdown');
                                        const dropdown = document.getElementById('agentDropdown');
                                        const selectedBox = document.getElementById('selectedAgents');

                                        toggleBtn.addEventListener('click', () => {
                                            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                                        });

                                        document.addEventListener('click', (e) => {
                                            if (!e.target.closest('.multi-select')) {
                                                dropdown.style.display = 'none';
                                            }
                                        });

                                        document.querySelectorAll('.agent-checkbox').forEach(cb => {
                                            cb.addEventListener('change', updateSelected);
                                        });

                                        function updateSelected() {
                                            selectedBox.innerHTML = '';
                                            const checked = document.querySelectorAll('.agent-checkbox:checked');

                                            toggleBtn.textContent = checked.length
                                                ? checked.length + ' participant(s) sélectionné(s)'
                                                : 'Sélectionner les participants';

                                            checked.forEach(cb => {
                                                const div = document.createElement('div');
                                                div.className = 'selected-item';
                                                div.innerHTML = `
                                                    <i>✔</i>
                                                    ${cb.dataset.name}
                                                    <span data-id="${cb.value}">×</span>
                                                `;
                                                selectedBox.appendChild(div);
                                            });
                                        }

                                        selectedBox.addEventListener('click', (e) => {
                                            if (e.target.tagName === 'SPAN') {
                                                const id = e.target.dataset.id;
                                                document.querySelector(`.agent-checkbox[value="${id}"]`).checked = false;
                                                updateSelected();
                                            }
                                        });
                                    </script>

{{-- 
                                    <div class="col-md-3 mb-10">

                                    </div> --}}
                                </div>
                                
                            @endif
                        @endif
                        {{-- <div id="autrePartPV">
                        </div> --}}
                        {{-- <a href="#" id="partPVAdd" style="float: right;"><i class="icon-plus txt-danger"></i></a> --}}
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnPv" type="submit">Valider</button>
                        <div class="loader-pendulums" id="prldPv" style="font-size:2rem;position:relative;margin:0px;padding:0px;display:none;top:0px;"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



