@extends('layouts.client-area')

@section('content')
<!-- ======= Contact Section ======= -->
<section id="account" class="contact formulaire">

  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Mon compte</h2>
    </div>
    @include('flash::message')


    <div class="row justify-content-center">
      <div class="col-md-12 col-sm-12 col-lg-12 col-12">


    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold" style="border: 2px solid blue;">
            <h6 style=""><img src="{{ URL::asset('/image/user.svg') }}" alt=""> <b>Informations du compte</b> </h5>

        </div>

        <div class="card-body">
            <form method="post" action="{{ route('account.update') }}">
              {{ csrf_field() }}
              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="nom"> <b> {{ __('Nom complet') }} </b> </label>
                    <input type="text" class="form-control" id="nom"  placeholder="Entrez un nom" value="{{ old('name') ?? $user->name }}" name="name">

                    @if($errors->has('name'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('name') }}
                      </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label for="contact"> <b>{{ __('Numéro de téléphone') }}</b> </label>
                    <input type="text" class="form-control" id="contact"  placeholder="Entrez votre numéro de téléphone" value="{{ old('contact') ?? $user->contact }}" name="contact" required>

                    @if($errors->has('contact'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('contact') }}
                      </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label for="email"> <b> {{ __('Adresse mail') }} </b></label>
                    <input type="email" class="form-control" id="email" aria-describedby="nameHelp" placeholder="Entrez votre adresse mail" value="{{ old('email') ?? $user->email }}" name="email" >
                    <small id="nameHelp" class="form-text text-muted">Cette adresse mail vous permet de vous connecter.</small>
                    @if($errors->has('email'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('email') }}
                      </div>
                    @endif
                </div>

              </div>
              <button type="submit" class="btn btn-success" name="button">
                Mettre à jour les informations
              </button>

            </form>
        </div>
    </div>




    <!-- MODIFICATION DU MOT DE PASSE -->
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold" style="border: 2px solid red;">
            <h6> <img src="{{ URL::asset('/image/font16/key.svg') }}" alt=""> <b>Modification du mot de passe</b> </h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('account.password.update') }}">
              {{ csrf_field() }}

              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="oldpassword"> <b><i class="fas fa-unlock"></i> Ancien mot de passe</b> </label>

                    <input type="password" class="form-control" id="oldpassword" placeholder="Entrez votre mot de passe actuel" name="password_old" required>
                    @if($errors->has('password_old'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('password_old') }}
                      </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="passwordnew"> <b><i class="fas fa-unlock"></i> Nouveau mot de passe</b> </label>
                    <input type="password" class="form-control" id="passwordnew" placeholder="Entrez le nouveau mot de passe" name="passwordnew" required>
                    @if($errors->has('passwordnew'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('passwordnew') }}
                      </div>
                    @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="passwordnew_confirm"> <b><i class="fas fa-unlock"></i> Nouveau mot de passe (Confirmation)</b> </label>
                    <input type="password" class="form-control" id="passwordnew_confirm" placeholder="Entrez à nouveau le mot de passe" name="passwordnew_confirmation" required>

                </div>

              </div>
              <button type="submit" class="btn btn-danger" name="button">
                Changer le mot de passe
              </button>

            </form>
        </div>
    </div>
    </div>
  </div>


</div>

</div>
</section>

<!-- End Contact Section -->

@endsection
