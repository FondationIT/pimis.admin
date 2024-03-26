<div>
    <div class="modal fade" id="prixModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prix par produit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">
                        @if (session()->has('message'))

                        <div class="alert alert-danger alert-wth-icon alert-dismissible fade show" role="alert">
                            <span class="alert-icon-wrap"><i class="zmdi zmdi-bug"></i></span>
                            {{session('message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif


                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="product">Produit *</label>
                                <select class="form-control select2 @error('product') is-invalid @enderror" wire:model.defer="state.product" name="product">
                                    <option value=""></option>
                                    @foreach ($products as $cat)
                                        <option value="{{$cat->id}}">{{App\Models\Product::where('id', $cat->product)->get()[0]->name.' '.$cat->marque.' '.$cat->model}}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="debut">Debut *</label>
                                <input type="date" class="form-control @error('debut') is-invalid @enderror" wire:model.defer="state.debut" name="debut">
                                @error('debut')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="fin">Fin *</label>
                                <input type="date" class="form-control @error('fin') is-invalid @enderror" wire:model.defer="state.fin" name="fin">
                                @error('fin')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-10">
                                <label for="prix">Prix *</label>
                                <input type="number" step="any" min="0.01" class="form-control @error('prix') is-invalid @enderror" wire:model.defer="state.prix" name="prix">
                                @error('prix')
                                    <span class="text-red-600" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" wire:loading.attr='disabled' id="btnCat" type="submit">Valider</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
