<?php

namespace App\Http\Controllers;

use App\Models\ConversionFee;
use Illuminate\Http\Request;

/**
 * Classe que controla as operações relacionadas à taxa de conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConversionFeeController extends Controller {

    /**
     * Retorna o valor da taxa de conversão a ser aplicada, baseada nos parâmetros armazenados no banco de dados
     *
     * @param float $valor Valor a ser convertido
     * @return float
     */
    public function getValorTaxaConversao($valor) {
        $registro = ConversionFee::select('taxa')->where('valorMaximo', '<=', $valor)->orderBy('valorMaximo', 'DESC')->limit(1);
        return $registro['taxa'];
    }
}
