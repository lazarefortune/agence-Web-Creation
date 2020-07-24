@extends('layouts.app')

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
    <section id="contact" class="contact formulaire">
      <br><br>
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Espace Client</h2>
        </div>

        <div class="row justify-content-center">





                <div class="col-md-8 col-sm-12 col-lg-8 col-12" >
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                          <b>{{ __('Créer un compte') }}</b>

                          <a class="btn btn-success" href="{{ route('login') }}">
                              {{ __('Se connecter') }}
                          </a>

                        </div>

                        <div class="card-body">
                          <form method="POST" action="{{ route('register') }}">
                              @csrf

                              <div class="form-group row">
                                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Votre nom') }}</label>

                                  <div class="col-md-6">
                                      <!-- <input id="name" style="text-transform:uppercase" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" > -->
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >

                                      @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <!-- <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="contact">{{ __('Numéro de téléphone') }}</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">241</div>
                                  </div>
                                  <input type="text" class="form-control" id="contact" placeholder="66112233">
                                </div>
                              </div> -->

                              <div class="form-group row">
                                  <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de téléphone') }}</label>

                                  <div class="col-md-6">
                                      <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" placeholder="exemple: 66112233">

                                      @error('contact')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse mail') }}</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <!-- <div class="form-group row">
                                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation') }}</label>

                                  <div class="col-md-6">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                  </div>
                              </div> -->

                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Créer mon compte') }}
                                      </button>
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
