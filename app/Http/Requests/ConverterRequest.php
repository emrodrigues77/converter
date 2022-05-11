<?php

namespace App\Http\Requests;

use App\Models\Parameter;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Classe que trata as requisições enviadas pelo formulário onde são informados os dados para conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConverterRequest extends FormRequest {
    /**
     * Determina se o usuário pode fazer essa requisição, bastando que ele esteja logado
     *
     * @return bool
     */
    public function authorize() {
        return auth()->check();
    }

    /**
     * Retorna as regras de validação da requisição
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'moedaOrigem' => 'required',
            'moedaDestino' => 'required|different:moedaOrigem',
            'valorConversao' => 'required|regex:/[0-9]+(\,[0-9]{2})?/|gte:' . Parameter::first()->valorMinimo . '|lte:' . Parameter::first()->valorMaximo,
            'payment_type' => 'required'
        ];
    }

    /**
     * Retorna as mensagens de erro a serem mostradas para cada erro de validação encontrado
     *
     * @return array<string, string>
     */
    public function messages() {
        return [
            'moedaOrigem.required' => 'Escolha a moeda de origem',
            'moedaDestino.required' => 'Escolha a moeda de destino',
            'moedaDestino.different' => 'A moeda de destino deve ser diferente da moeda de origem',
            'payment_type.required' => 'Escolha a forma de pagamento',
            'valorConversao.required' => 'Informe o valor a ser convertido',
            'valorConversao.regex' => 'Informe o valor a ser convertido em formato monetário',
            'valorConversao.gte' => 'O valor mínimo para conversão é ' . sprintf(
                "%s %s",
                request('moedaOrigem'),
                number_format(
                    Parameter::first()->valorMinimo,
                    2,
                    ',',
                    '.'
                )
            ),
            'valorConversao.lte' => 'O valor máximo para conversão é ' . sprintf("%s %s", request('moedaOrigem'), number_format(
                Parameter::first()->valorMaximo,
                2,
                ',',
                '.'
            )),
        ];
    }

    /**
     * Prepare dados da requisição para validação
     *
     * @return void
     */
    protected function prepareForValidation() {
        $this->merge([
            'valorConversao' => str_replace(['.', ','], ['', '.'], $this->valorConversao),
        ]);
    }
}
