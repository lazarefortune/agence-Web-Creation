@extends('layouts.monboncoin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Déposer une annonce</h1>
      <hr>
      <form action="{{ route('monboncoin.ads.create') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="title">Titre de l'annonce</label>
          <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" aria-describedby="title" value="{{ old('title') }}">
          @if ($errors->has('title'))
              <div class="invalid-feedback">{{  $errors->first('title') }}</div>
          @endif
        </div>
        <div class="form-group">
          <label for="description">Texte de l'annonce</label>
          <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
          @if ($errors->has('description'))
            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
          @endif
        </div>
        <div class="form-group">
          <label for="price" for="price">Prix</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">Fcfa</div>
            </div>
            <input type="number" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" name="price" id="price" value="{{ old('price') }}">
            @if ($errors->has('price'))
              <div class="invalid-feedback">{{ $errors->first('price') }}</div>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="localisation">Ville</label>
          <input type="text" class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" aria-describedby="localisation" value="{{ old('localisation') }}">
          @if ($errors->has('localisation'))
            <div class="invalid-feedback">{{ $errors->first('localisation') }}</div>
          @endif
        </div>
        @guest
          <div class="form-group">
            <h2>Vos informations</h2>
            <hr>
            <div class="row">


            <div class="col-md-12">
              <h4> <b>Inscription</b> </h4>
              <div class="alert alert-primary" role="alert">
                <a href="{{ route('login') }}">Connectez vous</a> si vous avez déjà un compte
              </div>
              <hr>
              <div class="form-group">
                <label for="pseudo">Nom complet</label>
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="pseudo" aria-describedby="pseudo" value="{{ old('name') }}">
                @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" id="contact" aria-describedby="contact" value="{{ old('contact  ') }}">
                @if ($errors->has('contact'))
                <div class="invalid-feedback">{{ $errors->first('contact') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" aria-describedby="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" >
                @if ($errors->has('password'))
                    <span class="invalid-feedback">{{  $errors->first('password') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="password_confirmation">Confirmation</label>
                <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">
                @if ($errors->has('password_confirmation'))
                  <span class="invalid-feedback">{{  $errors->first('password_confirmation') }}</span>
                @endif
              </div>
            </div>
            <!-- <div class="col-md-6">
              <h4> <b>Connexion</b> </h4>
              <hr>
            </div> -->
          </div>

          </div>

        @endguest
        <button type="submit" class="btn btn-primary btn-block">Valider</button>
      </form>
    </div>
  </div>
</div>
@endsection
