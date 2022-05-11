<?php

namespace App\Core;

use App\Exceptions\InvalidApiResponseException;
use Illuminate\Support\Facades\Http;

/**
 * Classe que efetua requisições à API com dados de câmbio
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ApiRetriever {

    /**
     * Faz uma requisição a API e retorna o valor de compra da moeda de destino desejada
     *
     * @param string $moedaOrigem Código da moeda origem
     * @param string $moedaDestino Código da moeda de destino
     * @throws InvalidApiResponseException
     * @return float
     */
    public static function getCurrencyExchangeRate($moedaOrigem, $moedaDestino) {

        /**
         * Enviando requisição à API, sendo que até 3 tentativas são feitas. Caso um erro ocorra, uma exceção é lançada.
         */
        $response = Http::retry(3, 100)
            ->get('https://economia.awesomeapi.com.br/last/' . sprintf('%s-%s', $moedaOrigem, $moedaDestino));

        /**
         * Verificando se ocorreu algum erro de cliente (400>) durante a operação de consulta à API, em caso positivo, uma exceção é lançada
         * e o fluxo é direcionado para um view informando sobre o erro.
         */
        if ($response->clientError()) {
            throw new InvalidApiResponseException("Erro ao Acessar API");
        }

        /**
         * Verificando se ocorreu algum erro de servidor (500>) durante a operação de consulta à API, em caso positivo, uma exceção é lançada
         * e o fluxo é direcionado para um view informando sobre o erro.
         */
        if ($response->serverError()) {
            throw new InvalidApiResponseException("Erro no Servidor");
        }

        $json = $response->json(sprintf('%s%s', $moedaOrigem, $moedaDestino));
        return $json['bid'];
    }
}
