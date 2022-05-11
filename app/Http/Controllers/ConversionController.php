<?php

namespace App\Http\Controllers;

use App\Core\ConvertAction;
use App\Exceptions\ConversionException;
use App\Http\Requests\ConverterRequest;
use App\Mail\ConversionResult;
use App\Models\Conversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Classe que controla as operações relacionadas ao processo de conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConversionController extends Controller {

    /**
     * Executa a conversão de valores contidos na request, invocando a ação de conversão, registrando a operação
     * no banco de dados, enviando um e-mail para o usuário e redirecionando o fluxo de execução
     * para a view que exibe o resultado da operação
     *
     * @param ConverterRequest $request Requisição com os dados necessários para a operação
     * @return view
     */
    public function executeConversion(ConverterRequest $request) {

        try {
            $converter = new ConvertAction(
                $request['moedaOrigem'],
                $request['moedaDestino'],
                $request['valorConversao'],
                $request['payment_type']
            );

            $converter->setUserId(Auth::id());
            $conversionData = $converter->getConversionData();

            $conversion = new Conversion($conversionData);
            $conversion->create($conversionData);
            Mail::to($request->user())->send(new ConversionResult($conversion));
            return view('converter.conversao', compact('conversion'));
        } catch (\Throwable $th) {
            throw new ConversionException('Erro ao efetuar conversão');
        }
    }

    /**
     * Direciona o fluxo de execução para a view que informa a ocorrência de um erro durante a operação de conversão
     *
     * @return view
     */
    public function error() {
        return view('converter.error');
    }

    /**
     * Grava os dados da conversão no banco de dados
     *
     * @param array $conversionData Array com os dados da operação
     * @return void
     */
    public function store($conversionData) {
        $conversion = new Conversion();
        $conversion->create($conversionData);
    }
}