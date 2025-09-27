<?php

class InputHelper {

    // limpa a string aplicando trim e convertendo caracteres especiais em entidades HTML
    // isso ajuda a prevenir ataques XSS (cross-site-scripting)
    public static function limpaString(string $string) : string {
        // trim() - remove os espaços em branco no inicio e no final da string
        // htmlspecialchars - converte caracteres como <,>,& e etc em suas entidades HTML, impedindo que o navegador os interprete como código
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }

    // itera sobre um array (como $_POST e $_GET) e limpa cada um de seus valores
    // usando o método limpaString(
    public static function limpaArray(array $array) : array {
        $arrayLimpo = [];
        foreach ($array as $key => $value) {
            // verifica se o valor é ums string antes de limpar
            if (is_string($value)) {
                $arrayLimpo[$key] = self::limpaString($value);
            } else {
                // se não for uma string (pode ser um array, por exemplo), mantem o valor original
                $arrayLimpo[$key] = $value;
            }
        }
        return $arrayLimpo;
    }

    // verifica se um campo obrigatório não está vazio
    // retorna true se estiver ok, e false se estiver vazio
    public static function validaRequerido(string $valor) : bool {
        return !empty($valor);
    }
}