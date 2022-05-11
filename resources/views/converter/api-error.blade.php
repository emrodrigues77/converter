@extends('layouts.app')

<!--
View que informa sobre um erro durante um processo de requisição à API
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 shadow p-3 rounded">
                <h1 class="display-4">Atenção</h1>
                <hr />

                <p>
                    Infelizmente, uma dificuldade técnica impediu a realização da conversão.
                </p>
                <p>
                    Pedimos desculpas pelo transtorno.
                </p>
                <p>
                    {{ request() }}
                </p>
                <p>
                    <a href="{{ route('conversor') }}" class="btn btn-primary">Tentar Novamente</a>
                </p>
            </div>
        </div>
    @endsection
