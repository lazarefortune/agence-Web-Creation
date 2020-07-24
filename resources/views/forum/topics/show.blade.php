@extends('layouts.forum')

@section('extra-js')
    <script>
        function toggleReplyComment(id)
        {
            let element = document.getElementById('replyComment-' + id);
            element.classList.toggle('d-none');
        }
    </script>
@endsection

@section('content')
    <div class="container">
      <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('forum.topics.index') }}"  class="btn btn-primary btn-sm">Retour</a>
      </div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-info">{{ $topic->title }}</h3>
                <p>{{ $topic->content }}</p>
                <div class="d-flex flex-column">
                <small>Posté <b>{{ Carbon\Carbon::parse($topic->created_at)->diffForHumans() }}</b> par <span class="badge badge-primary">{{ $topic->user->name }}</span></small>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    @can('update', $topic)
                    <a href="{{ route('forum.topics.edit', $topic) }}" class="btn btn-warning">Editer ce topic</a>
                    @endcan
                    @can('delete', $topic)


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                      supprimer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Souhaitez vous vraiment supprimer ce sujet ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('forum.topics.destroy', $topic) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    @endcan

                </div>
            </div>
        </div>
        <hr>
        <h5>Commentaires</h5>
        @forelse ($topic->comments as $comment)
            <div class="card mb-2 @if($topic->solution === $comment->id) border-success @endif">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                    {{ $comment->content }}
                        <div class="d-flex flex-column">
                        <small>Posté le {{ $comment->created_at->format('d/m/Y') }} par <span class="badge badge-primary">{{ $comment->user->name }}</span></small>
                        </div>
                    </div>
                    <div>
                        @auth
                            @if (!$topic->solution && auth()->user()->id === $topic->user_id)
                                <!-- <solution-button topic-id="{{ $topic->id }}" comment-id="{{ $comment->id }}"></solution-button> -->
                                <form class="" action="{{ route('forum.comments.markedAsSolution', [$topic,$comment->id]) }}" method="post">
                                  @csrf
                                  <button type="submit" class="btn btn-success">Marquer comme solution</button>
                                </form>
                            @else
                                @if ($topic->solution === $comment->id)
                                    <span class="badge badge-success">Solution</span>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @auth
            <button class="btn btn-secondary mb-3" onclick="toggleReplyComment({{ $comment->id }})">Répondre</button>
            <form action="{{ route('forum.comments.storeReply', $comment) }}" method="POST" class="mb-3 ml-5 d-none" id="replyComment-{{ $comment->id }}">
                @csrf
                <div class="form-group">
                    <label for="replyComment">Ma réponse</label>
                    <textarea name="replyComment" class="form-control @error('replyComment') is-invalid @enderror" id="replyComment" rows="3"></textarea>
                    @error('replyComment')
                        <div class="invalid-feedback">{{ $errors->first('replyComment') }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Répondre à ce commentaire</button>
            </form>
            @endauth
            @foreach ($comment->comments as $replyComment)
                <div class="card mb-2 ml-5">
                <div class="card-body">
                    {{ $replyComment->content }}
                    <div class="d-flex flex-column">
                    <small>Posté le {{ $comment->created_at->format('d/m/Y') }} par <span class="badge badge-primary">{{ $replyComment->user->name }}</span></small>
                    </div>
                </div>
            </div>
            @endforeach
        @empty
            <div class="alert alert-info">Aucun commentaire pour ce topic</div>
        @endforelse
        @auth
        <form action="{{ route('forum.comments.store', $topic) }}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="content">Votre commentaire</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Soumettre mon commentaire</button>
        </form>
        @else
        <div class="alert alert-info"><a href="{{ route('login') }}">Connectez-vous</a> pour participer au sujet ;)</div>
        @endauth
    </div>
@endsection
