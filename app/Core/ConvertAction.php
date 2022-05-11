<?php

namespace App\Core;

use App\Exceptions\ConversionException;
use App\Models\Conversion;
use Illuminate\Support\Facades\DB;

/**
 * Classe que efetua a conversão de valores
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConvertAction {

    /**
     * Código da moeda de origem
     *
     * @var string
     */
    private $moedaOrigem;

    /**
     * Código da moeda de destino
     *
     * @var string
     */
    private $moedaDestino;

    /**
     * Montante a ser convertido
     *
     * @var float
     */
    private $valorConversao;

    /**
     * Identificador da forma de pagamento
     *
     * @var int
     */
    private $payment_type_id;

    /**
     * Identificador do usuário que fez a conversão
     *
     * @var int
     */
    private $user_id;

    /**
     * Construtor da classe
     *
     * @param string $moedaOrigem Código da moeda de origem
     * @param string $moedaDestino Código da moeda de destino
     * @param float $valorConversao Montante a ser convertido
     * @param int $payment_type_id Identificador da forma de pagamento
     */
    public function __construct($moedaOrigem, $moedaDestino, $valorConversao, $payment_type_id) {
        $this->moedaOrigem = $moedaOrigem;
        $this->moedaDestino = $moedaDestino;
        $this->valorConversao = $valorConversao;
        $this->payment_type_id = $payment_type_id;
    }

    /**
     * Calcula e retorna os dados da conversão num array
     *
     * @throws ConversionException
     * @return array
     */
    public function getConversionData() {

        try {
            $taxaConversao = $this->calculateConversionFee();
            $taxaPagamento = $this->calculatePaymentFee();
            $valorConvertido = $this->valorConversao - $taxaConversao - $taxaPagamento;
            $cambioMoedaDestino = $this->getDestinationExchangeRate();
            $valorMoedaDestino = 1 / $cambioMoedaDestino;
            $valorCompradoMoedaDestino = $valorConvertido / $valorMoedaDestino;

            $conversionData = [
                'user_id' => $this->user_id,
                'moedaOrigem' => $this->moedaOrigem,
                'moedaDestino' => $this->moedaDestino,
                'valorConversao' => $this->valorConversao,
                'payment_type_id' => $this->payment_type_id,
                'valorMoedaDestino' => $valorMoedaDestino,
                'valorCompradoMoedaDestino' => $valorCompradoMoedaDestino,
                'taxaConversao' => $taxaConversao,
                'taxaPagamento' => $taxaPagamento,
                'valorConvertido' => $valorConvertido,
            ];

            return $conversionData;
        } catch (\Throwable $th) {
            throw new ConversionException('Erro ao efetuar conversão' . $th->getMessage());
        }
    }

    /**
     * Calcula a taxa de conversão, de acordo com os parâmetros armazenados no banco de dados
     *
     * @return float
     */
    private function calculateConversionFee() {
        $taxa = DB::scalar(
            'SELECT taxa FROM conversion_taxes WHERE valorMaximo >= ? ORDER BY valorMaximo ASC LIMIT 1',
            [$this->valorConversao]
        );
        return $taxa * $this->valorConversao / 100;
    }

    /**
     * Calcula a taxa de pagamento, de acordo com os parâmetros armazenados no banco de dados
     *
     * @return float
     */
    private function calculatePaymentFee() {
        $taxa = DB::scalar(
            'SELECT taxa FROM payment_types WHERE id = ?',
            [$this->payment_type_id]
        );
        return $taxa * $this->valorConversao / 100;
    }

    /**
     * Retorna a taxa de conversão entre as moedas selecionadas, obtida através de uma consulta à API
     *
     * @return float
     */
    private function getDestinationExchangeRate() {
        $exchangeRate = ApiRetriever::getCurrencyExchangeRate($this->moedaOrigem, $this->moedaDestino);
        return $exchangeRate;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
}
