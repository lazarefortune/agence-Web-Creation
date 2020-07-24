@extends('layouts.app')

@section('content')

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact formulaire">
  <br><br>
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Espace Client</h2>
    </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <b>{{ __('Réinitialisation du mot de passe') }}</b>
                  <a href="{{ url('login') }}" type="button"  class="btn btn-sm btn-danger" name="button">Annuler</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Votre adresse mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Envoyer le lien de réinitialisation') }}
                                </button><hr>

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
