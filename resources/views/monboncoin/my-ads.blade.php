@extends('layouts.monboncoin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6>Je possède <span class="text-success">{{ $ads->total() }}</span> annonce(s).</h6>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Mes Annonces</h1>

            @include('flash::message')
            <div id="results">
                @foreach ($ads as $ad)
                <div class="card mb-3">
                    <img class="card-img-top" src="https://via.placeholder.com/600x150" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ad->title }}</h5>
                        <div class="mb-3">
                            <small class="badge badge-secondary">Publiée {{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                        </div>
                        Localisation: <small class="card-text text-info">{{ $ad->localisation }}</small>
                        <p class="card-text mt-3">{!! $ad->description !!}</p>
                        <p class="card-text"><div class="badge badge-pill badge-light">{{ $ad->price / 100 }} Fcfa</div></p>
                        <a href="{{ route('monboncoin.ads.show', ['id' => $ad->id]) }}" class="btn btn-primary">Voir l'annonce</a>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $ads->links() }}
        </div>
    </div>
</div>
@endsection
