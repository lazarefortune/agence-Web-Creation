@extends('layouts.forum')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 mb-4">
            @auth
            <a href="{{ route('forum.topics.create') }}" type="button"  class="btn btn-primary btn-block" name="button"><i class="fa fa-plus-circle"></i> Créer un sujet</a>
            <a href="{{ route('forum.topics.index') }}" type="button"  class="btn btn-success btn-block" name="button"><i class="fa fa-folder-open"></i> Tous les sujets</a>
            @else
              <div class="alert alert-info"><a href="{{ route('login') }}">Connectez-vous</a> pour créer un sujet ;-)</div>
            @endauth
          </div>

          <div class="col-12 col-sm-12 col-md-9 col-lg-9 p-0">

            <div class="container input-group mb-3">
              <input class="form-control " type="text" name="q" placeholder="Rechercher" aria-label="Search">

              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                  <i  class="fa fa-search"></i>
                </button>
              </div>
            </div>

            <div class="container">
              @include('flash::message')
              <div class="list-group">

                @if($myTopics->isEmpty())
                  <div class="alert alert-info">
                    Vous n'avez aucun sujet créé</a>
                  </div>
                @endif

                  @foreach ($myTopics as $topic)
                  <div class="list-group-item mb-2">
                      <h4><a href="{{ route('forum.topics.show', $topic) }}">{{ $topic->title }}</a></h4>
                      <p>{{ $topic->content }}</p>
                      <div class="d-flex flex-column">
                      <small>Posté <b>{{ Carbon\Carbon::parse($topic->created_at)->diffForHumans() }}</b> par <span class="badge badge-primary">{{ $topic->user->name }}</span></small>
                      </div>
                  </div>
                  @endforeach

              </div>
              <div class="d-flex justify-content-center mt-3">
                  {{ $myTopics->links() }}
              </div>
            </div>

          </div>
        </div>


    </div>
@endsection
