@extends('layouts.client-area')

@section('content')

<h2 class="mb-4">Espace client</h2>


<div class="card mb-4">
    <div class="card-body">
        <button type="button"  class="btn btn-primary" name="button">Commander un site web</button>
        <hr>
        <button type="button"  class="btn btn-secondary" name="button">Service carte de visite</button>
        <hr>
        <button type="button"  class="btn btn-warning" name="button">Service CANALBOX</button>
        <hr>
        <a href="{{ route('forum.topics.index') }}" type="button"  class="btn btn-success" name="button">Accéder au forum</a>
        <hr>
        <a href="{{ route('streaming.index') }}" type="button"  class="btn btn-info" name="button">Service Netflix</a>
        <hr>
        <a href="{{ route('monboncoin.ads.index') }}" type="button"  class="btn btn-info" name="button">Annonces</a>
    </div>
</div>

@endsection
