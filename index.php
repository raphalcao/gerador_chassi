<?php
/* Criando Exceptions */

interface ExceptionInterface
{
}

class InvalidChassiException extends \InvalidArgumentException implements ExceptionInterface
{
}

class Chassi
{
    private $chassi;

    /**
     * @param string $chassi
     */
    public function __construct($chassi)
    {
        if ($this->validate($chassi) === false) {
            throw new InvalidChassiException;
        }
        return $this->chassi = $chassi;
    }

    public function __toString()
    {
        return $this->chassi;
    }

    private function validate($chassi)
    {
        $chassi = strtoupper(str_replace(' ', '', $chassi));

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($chassi) != 17) {
            return false;
        }

        // Verifica se existe as letras 'I', 'O', 'Q'
        $array = ['I', 'O', 'Q'];

        foreach ($array as $arr) {
            if (preg_match("/{$arr}/i", $chassi)) {
                return false;
            }
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: AAAAAAAAAAAAAAAAA
        if (preg_match('/^(.)\1*$/', $chassi)) {
            return false;
        }
        return true;
    }
}

// Troque o valor do chassi para continuar o teste
try {
    $chassi = new Chassi('7fXtzANjD1T515961');

    echo strtoupper($chassi);
} catch (InvalidChassiException $e) {
    echo "Chassi invalido";
} catch (Exception $e) {
    echo "Erro Inesperado";
}
