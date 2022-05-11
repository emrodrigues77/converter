<?php

namespace App\Http\Controllers;

use App\Core\ConvertAction;
use App\Http\Requests\ConverterRequest;
use App\Models\Currency;
use App\Models\Parameter;
use App\Models\PaymentType;
use Illuminate\Http\Request;

/**
 * Classe que controla as operações relacionadas à view onde são informados os parâmetros de conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConverterController extends Controller {

    /**
     * Método que invoca a view com a view onde são informados os parâmetros de entrada para a conversão
     *
     * @return view
     */
    public function index() {
        $currencies = Currency::all();
        $parameters = Parameter::first();
        $paymentTypes = PaymentType::all();

        return view('converter.index', compact('currencies', 'parameters', 'paymentTypes'));
    }
}
