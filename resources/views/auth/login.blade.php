@extends('layouts.app')
@section('contentCSS')
<style>
.connexion .form-group input{
  /* border-bottom: 1px solid black !important; */
  border-top:none;
  border-left:none;
  border-right:none;
  box-shadow: none;
  border-radius: 0;
    /* outline: blue auto 0px ; */
}
.connexion .form-group input:focus{
  border: 2px solid blue !important;
  border-radius: 4px;
  box-shadow: none;
    /* outline: blue auto 0px ; */
}
.connexion .btn-primary
{
  background-color: #0b2a64 !important;
  border: none;
}
.connexion .btn-primary:hover
{
  background-color: #303d72 !important;
  border: none;
}
</style>
@endsection
@section('menu')

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center">

    <h1 class="logo mr-auto"><a href="{{ url('/') }}"> <img src="" alt="" style="height: 30px; width: 80px;"> </a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="{{ url('/') }}">Accueil</a></li>
        <li><a href="{{ url('/#about') }}">A propos</a></li>
        <li><a href="{{ url('/#services') }}">Nos Services</a></li>
        <li><a href="{{ url('/#team') }}">Notre équipe</a></li>
        <li><a href="{{ url('/#contact') }}">Contact</a></li>

      </ul>
    </nav><!-- .nav-menu -->

    <!-- <a href="{{ route('login') }}" class="get-started-btn scrollto">Espace client</a> -->


  </div>
</header><!-- End Header -->

@endsection

@section('content')



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="formulaire">
      <br><br>
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Espace Client</h2>
        </div>

        <div class="row justify-content-center connexion">





                <div class="col-md-8 col-sm-12 col-lg-8 col-12" >
                    <div class="card php-email-form2">
                        <div class="card-header d-flex justify-content-between">

                          <b>{{ __('Se connecter') }}</b>

                          <a class="btn btn-success" href="{{ route('register') }}">
                              {{ __('Créer un compte') }}
                          </a>

                        </div>

                        <div class="card-body">
                          <form method="POST" action="{{ route('login') }}">
                              @csrf

                              <div class="form-group row">
                                  <label for="login" class="col-sm-4 col-form-label text-md-right">
                                      {{ __('Contact ou Email') }}
                                  </label>

                                  <div class="col-md-6">
                                      <input id="login" type="text"
                                             class="form-control{{ $errors->has('contact') || $errors->has('email') ? ' is-invalid' : '' }}"
                                             name="login" value="{{ old('contact') ?: old('email') }}" required >

                                      @if ($errors->has('contact') || $errors->has('email'))
                                          <span class="invalid-feedback">
                                              <strong>{{ $errors->first('contact') ?: $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <!-- <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div> -->

                              <div class="form-group row">
                                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-md-6 offset-md-4">
                                      <div class="custom-control custom-checkbox">
                                          <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                          <label class="custom-control-label" for="remember">
                                              {{ __('Se souvenir de moi') }}
                                          </label>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-8 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Se connecter') }}
                                      </button>

                                      @if (Route::has('password.request'))
                                          <a class="btn btn-link" href="{{ route('password.request') }}">
                                              {{ __('Mot de passe oublié ?') }}
                                          </a>
                                      @endif
                                  </div>
                              </div>
                          </form>
                        </div>
                    </div>
                </div>


        </div>

        </div>

      </div>
    </section>

    <!-- End Contact Section -->

  </main><!-- End #main -->


@endsection
