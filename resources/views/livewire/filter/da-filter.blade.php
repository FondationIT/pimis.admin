<div>
    <form wire:submit.prevent='filterData' wire:reset.prevent=''>
        <div class="form-row">
            <div hidden>{{$modelId}}</div>
            
            <div class="col-md-9 mb-10">
                <div class="row">
                    <div class="col-md-3 mb-10">
                        <input class="form-control @error('debut') is-invalid @enderror" wire:model.defer="state.debut" type="date">
                        @error('debut')
                            <span class="text-red-600" role="alert" >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>-
                    <div class="col-md-3 mb-10">
                        <input class="form-control @error('fin') is-invalid @enderror" wire:model.defer="state.fin" type="date">
                        @error('fin')
                            <span class="text-red-600" role="alert" >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-10">
                        <select class="form-control @error('projet') is-invalid @enderror" wire:model.defer="state.projet">
                            <option value="">Projet</option>
                            <option value="0">Tous</option>
                            @if (Auth::user()->role == 'C.P' || Auth::user()->role == 'COMPT2')
                                @foreach ($affectation as $aff)
                                    <option value="{{$aff->projet}}">{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</option>
                                @endforeach
                            @else
                                @foreach ($projet as $aff)
                                    <option value="{{$aff->id}}">{{$aff->name}}</option>
                                @endforeach
                            @endif

                        </select>
                        @error('projet')
                            <span class="text-red-600" role="alert" >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-2 mb-10">
                        <select class="form-control @error('status') is-invalid @enderror" wire:model.defer="state.status" type="text">
                            <option value="">Status</option>
                            <option value="0">Tous</option>
                            <option value="1">Approuver</option>
                            <option value="2">En cours</option>
                            <option value="3">Refuser</option>
                        </select>
                        @error('status')
                            <span class="text-red-600" role="alert" >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="col-md-1 mb-10">
                <button class="btn btn-primary" wire:loading.attr='disabled' type="submit">Filter</button>
            </div>

            <div class="col-md-1 mb-10">
                <button class="btn btn-secondary" type="reset" wire:loading.attr='disabled' wire:click='resetForm' >Reinitialiser</button>
            </div>
        </div>
    </form>
</div>
