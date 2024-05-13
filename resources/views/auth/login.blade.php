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

        <div style="width:350px;">
            <div class="card">
                <div class="card-header">{{ __('CONNEXION') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">

                            <div class="input-group mb-3">

                                <div class="input-group-addon">
                                    <span class="fa fa-user"></i>
                                </div>

                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nom d'utilisateur">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-4" id="show_hide_password">
                                <div class="input-group-addon">
                                    <span class="fa fa-lock"></i>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe">

                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash ii" aria-hidden="true"></i></a>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                <button type="submit" style="width: 100%;" class="btn btn-primary">
                                    {{ __('Connexion') }}
                                </button>


                            </div>

                        </div>
                    </form>
                </div>
            </div>
            @if (Route::has('password.request'))
                <a class="btn btn-link text-center" style="color: #888" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif
        </div>
    </div>
</div>


 <x-script></x-script>

 <script>
        $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('.ii').addClass( "fa-eye-slash" );
            $('.ii').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('.ii').removeClass( "fa-eye-slash" );
            $('.ii').addClass( "fa-eye" );
        }
    });
});
    </script>
</body>
</html>
