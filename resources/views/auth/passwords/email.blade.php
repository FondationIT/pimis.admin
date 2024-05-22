<!DOCTYPE html>
<html>
<head>
    <x-meta></x-meta>
</head>
<body class="hold-transition login-page">

<div class="container">
    <div class="login-logo">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
               src="{{asset('img/logo/logo.png')}}"
               alt="User profile picture">
        </div>
        <h3 style="color:#9e830a">PIMIS Admin</h3>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('MOT DE PASSE OUBLIE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (Route::has('password.request'))
                <a class="btn btn-link text-center" style="color: #888" href="{{ route('login') }}">
                    {{ __('Connectez-vous') }}
                </a>
            @endif
        </div>
    </div>
</div>


 <x-script></x-script>

</body>
</html>
