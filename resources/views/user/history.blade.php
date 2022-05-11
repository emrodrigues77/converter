@extends('layouts.app')

<!--
View que exibe o histórico de conversões do usuário, obtidas através de um relacionamento entre os modelos de dados.
A exibição utiliza o recurso Datatable do jQuery para exibição tabular, filtragem e ordenação dos dados
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 shadow p-3 rounded">
                <h1>Histórico de Conversões</h1>

                <div class='p-4'>
                    <table class="table table-bordered table-striped table-hover table-responsive mt-2" id="dataTable"
                        width="100%" cellspacing="0">
                        <caption>Histórico de Conversões</caption>
                        <thead class='table-dark'>
                            <tr class="text-end">
                                <th class="text-start">Data</th>
                                <th>Origem/Destino</th>
                                <th>Taxa de Câmbio</th>
                                <th>Taxa de Conversão</th>
                                <th>Taxa de Pagamento</th>
                                <th>Tipo de Pagamento</th>
                            </tr>
                        </thead>
                        <tfoot class='table-dark'>
                            <tr class="text-end">
                                <th class="text-start">Data</th>
                                <th>Origem/Destino</th>
                                <th>Taxa de Câmbio</th>
                                <th>Taxa de Conversão</th>
                                <th>Taxa de Pagamento</th>
                                <th>Tipo de Pagamento</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach (auth()->user()->conversions as $conversion)
                                <tr class='text-end align-middle'>
                                    <td class="text-start">
                                        {{ date('d/m/Y H:i:s', strtotime($conversion->created_at)) }}
                                    </td>
                                    <td>
                                        {{ $conversion->moedaOrigem }} {{ $conversion->valorConversao }}
                                        <br />
                                        {{ $conversion->moedaDestino }} {{ $conversion->valorCompradoMoedaDestino }}
                                    </td>
                                    <td>
                                        {{ $conversion->valorMoedaDestino }}
                                    </td>
                                    <td>
                                        {{ $conversion->moedaOrigem }} {{ $conversion->taxaConversao }}
                                    </td>
                                    <td>
                                        {{ $conversion->moedaOrigem }} {{ $conversion->taxaPagamento }}
                                    </td>
                                    <td>
                                        {{ $conversion->paymentType->nome }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endsection
