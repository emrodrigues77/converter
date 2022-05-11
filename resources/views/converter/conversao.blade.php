@extends('layouts.app')

<!--
View que mostra o resultado da conversão
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 shadow p-3 rounded">
                <h1 class="display-4">Resultado da Conversão</h1>
                <hr />

                <p>
                    <strong>Moeda de origem: </strong> {{ $conversion->moedaOrigem }}
                </p>
                <p>
                    <strong>Moeda de destino: </strong> {{ $conversion->moedaDestino }}
                </p>
                <p>
                    <strong>Valor para conversão: </strong> {{ $conversion->moedaOrigem }}
                    {{ $conversion->valorConversao }}
                </p>
                <p>
                    <strong>Forma de pagamento: </strong> {{ $conversion->paymentType->nome }}
                </p>
                <p>
                    <strong>Valor da moeda de destino usado para conversão: </strong>
                    {{ $conversion->moedaOrigem }} {{ $conversion->valorMoedaDestino }}
                </p>
                <p>
                    <strong>Valor comprado em moeda de destino: </strong>
                    {{ $conversion->moedaDestino }} {{ $conversion->valorCompradoMoedaDestino }}
                </p>
                <p>
                    <strong>Taxa de pagamento: </strong>
                    {{ $conversion->moedaOrigem }} {{ $conversion->taxaPagamento }}
                </p>
                <p>
                    <strong>Taxa de conversão: </strong>
                    {{ $conversion->moedaOrigem }} {{ $conversion->taxaConversao }}
                </p>
                <p>
                    <strong>Valor utilizado para conversão descontando as taxas: </strong>
                    {{ $conversion->moedaOrigem }} {{ $conversion->valorConvertido }}
                </p>
                <p>
                    <strong>Cotação realizada em: </strong> {{ date('d/m/Y H:i:s') }}
                </p>
                <p>
                    <a href="{{ route('conversor') }}" class="btn btn-primary">Fazer Outra Conversão</a>
                </p>
            </div>
        </div>
    @endsection
