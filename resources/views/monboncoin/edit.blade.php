@extends('layouts.monboncoin')
@section('content')
<div class="container">
  <a href="{{ route('monboncoin.ads.index') }}" class="btn btn-primary mb-3">Retour aux annonces</a>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Edition de l'annonce</h1>
      <hr>
      <form action="{{ route('monboncoin.ads.update', ['id' => $ad->id]) }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="title">Titre de l'annonce</label>
          <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" aria-describedby="title" value="{{ $ad->title }}">
          @if ($errors->has('title'))
              <div class="invalid-feedback">{{  $errors->first('title') }}</div>
          @endif
        </div>
        <div class="form-group">
          <label for="description">Texte de l'annonce</label>
          <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" cols="20" rows="5">{{ $ad->description }}</textarea>
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
            <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" name="price" id="price" value="{{ old('price') ?? $ad->price }}">
            @if ($errors->has('price'))
              <div class="invalid-feedback">{{ $errors->first('price') }}</div>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="localisation">Ville</label>
          <input type="text" class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" aria-describedby="localisation" value="{{ $ad->localisation }}">
          @if ($errors->has('localisation'))
            <div class="invalid-feedback">{{ $errors->first('localisation') }}</div>
          @endif
        </div>

        <button type="submit" class="btn btn-success btn-block">Mettre à jour</button>
      </form>
    </div>
  </div>
</div>
@endsection
