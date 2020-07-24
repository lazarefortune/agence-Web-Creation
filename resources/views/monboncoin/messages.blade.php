@extends('layouts.monboncoin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mes messages</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Emetteur</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                            <tr>
                                <td scope="row">{{ getUserName($message->buyer_id) }}</td>
                                <td>{{ $message->content }}</td>
                                <td>
                                  <a href="{{ route('monboncoin.contact.index', ['seller_id' => $message->buyer_id, 'ad_id' => $message->ad_id]) }}" class="btn btn-primary btn-sm">Répondre</a>
                                  <a href="{{ route('monboncoin.ads.show', ['id' => $message->ad_id]) }}" class="btn btn-warning btn-sm">Voir l'article</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
