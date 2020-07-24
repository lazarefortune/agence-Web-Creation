@extends('layouts.monboncoin')
@section('content')
<div class="container">

  @include('flash::message')

  <a href="{{ route('monboncoin.ads.index') }}" class="btn btn-primary mb-3">Retour aux annonces</a>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mb-3">
        <img class="card-img-top" src="https://via.placeholder.com/600x150" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{ $ad->title }}</h5>
          <div class="mb-3">
            <small class="badge badge-secondary">Publiée {{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
          </div>
          Localisation: <small class="card-text text-info">{{ $ad->localisation }}</small>
          <p class="card-text mt-3">{!! $ad->description !!}</p>
          <p class="card-text">
            <div class="badge badge-pill badge-light">{{ number_format($ad->price) }} Fcfa</div>
          </p>


          <!-- <a href="{{ route('monboncoin.ads.show', ['id' => $ad->id]) }}" class="btn btn-primary">Voir l'annonce</a> -->


        </div>
      </div>
    </div>
    <div class="col-md-4">
      @auth
      @if((auth()->user()->id) == $ad->user->id )
        <a href="{{ route('monboncoin.ads.edit', ['id' => $ad->id]) }}"  class="btn btn-warning btn-block">Editer</a>
        <hr>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModalScrollable">
          Supprimer
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"> <b>Suppression</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Souhaitez vous vraiment supprimer cette annonce ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form action="{{ route('monboncoin.ads.destroy', ['id' => $ad->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      @else
        <h3>Annonce de {{ $ad->user->name }}</h3>
        <a href="{{ route('monboncoin.contact.index', ['seller_id' => $ad->user->id, 'ad_id' => $ad->id]) }}" class="btn btn-block btn-success">Envoyez un message</a>

      @endif
      @else
      <h3>Annonce de {{ $ad->user->name }}</h3>
      <a href="{{ route('monboncoin.contact.index', ['seller_id' => $ad->user->id, 'ad_id' => $ad->id]) }}" class="btn btn-block btn-success">Envoyez un message</a>
      @endauth
    </div>
  </div>
</div>
@endsection
