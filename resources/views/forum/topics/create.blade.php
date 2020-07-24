@extends('layouts.forum')

@section('extra-js')
    {!! NoCaptcha::renderJs() !!}

  
@endsection

@section('content')
    <div class="container">
        <h1>Créer un sujet</h1>
        <hr>
        <form action="{{ route('forum.topics.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre du sujet</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Votre message</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content') }}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $errors->first('content') }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
        </div>



        <button type="submit" class="btn btn-primary">Créer mon topic</button>
        </form>
    </div>
@endsection
