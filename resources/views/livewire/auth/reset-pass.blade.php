<div>
    <div class="auth-form-wrap pt-xl-0 pt-70">
        <div class="auth-form w-xl-30 w-sm-50 w-100">
           
            <form wire:submit.prevent='submit'>
                <p class="display-6 mb-30 text-center">Voulez-vous changer votre mot de passe</p>
                <div class="form-group">
                    <input class="form-control @error('password') is-invalid @enderror" name="password" wire:model.defer="state.password" placeholder="Nouveau mot de passe" type="password">
                    @error('password')
                        <span class="text-red-600" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" wire:model.defer="state.password_confirmation" placeholder="Confirmer le password" type="password">
                        <div class="input-group-append">
                            <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <span class="text-red-600" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button class="btn btn-primary btn-block mb-20" wire:loading.attr='disabled' type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
