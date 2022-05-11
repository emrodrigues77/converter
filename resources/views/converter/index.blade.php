@extends('layouts.app')

<!--
View principal do conversor, onde são informados os parâmetros de entrada
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 shadow p-3 rounded">
                <h1 class="display-4">Converter Moedas</h1>
                <hr />

                <form action="{{ route('converter') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="moedaOrigem" class="form-label">Moeda de Origem</label>
                        <select class="form-select @error('moedaOrigem') is-invalid @enderror" id="moedaOrigem"
                            name="moedaOrigem">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->codigo }}" @if ($currency->codigo === $parameters->moedaPadrao) selected @endif>
                                    {{ $currency->nome }}
                                </option>
                            @endforeach
                        </select>

                        @error('moedaOrigem')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="moedaDestino" class="form-label">Moeda de Destino</label>
                        <select class="form-select @error('moedaDestino') is-invalid @enderror" id="moedaDestino"
                            name="moedaDestino">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->codigo }}">
                                    {{ $currency->nome }}
                                </option>
                            @endforeach
                        </select>

                        @error('moedaDestino')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="valorConversao" class="form-label">Valor para Conversão</label>
                        <input type="text" class="form-control @error('valorConversao') is-invalid @enderror"
                            id="valorConversao" name="valorConversao" value={{ old('valorConversao') }}>

                        @error('valorConversao')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="payment_type" class="form-label">Forma de Pagamento</label>
                        <select class="form-select @error('payment_type') is-invalid @enderror" id="payment_type"
                            name="payment_type">
                            @foreach ($paymentTypes as $paymentType)
                                <option value="{{ $paymentType->id }}">
                                    {{ $paymentType->nome }}
                                </option>
                            @endforeach
                        </select>

                        @error('payment_type')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <button class="btn btn-primary" type="submit">Converter</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- scripts de suporte para a página, que proporcionam validação e formatação da entrada de dados -->
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/converter.index.js') }}"></script>
    @endsection
