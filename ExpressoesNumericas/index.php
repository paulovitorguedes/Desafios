<?php

$expressao = array();
$resultExpressao = array();
$fileName = realpath("d14.txt");

if (file_exists($fileName)) {
    $file = fopen($fileName, "r");

    while (!feof($file)) {
        $line = str_replace("^", "**", fgets($file)); 
        $expressao[] = preg_replace('/[^0-9+\-.*\/()%]/', '', $line);
    }
    echo var_dump($expressao);
    fclose($file);
}

// Verifica se a expressão foi fornecida
// echo count($expressao);
if (count($expressao) > 0) {
    // Calcula e exibe o resultado da expressão
    $resultado = calcularExpressao($expressao);
    echo var_dump($resultado);
    //echo "O resultado da expressão $expressao é: $resultado";
} else {
    echo "Por favor, forneça uma expressão para calcular.";
}





// Função para validar a expressão matemática
function validarExpressao($expressao)
{
    // Usa uma expressão regular para verificar se a expressão é válida
    //Retorna 1 se toda a expressao contem os valores citados e retorna o se conter caracteres inválidos
    if (!preg_match('/^[0-9+\-.*\/()% ]+$/', $expressao)) {
        return false;
    }
    return true;
}

// Função para avaliar uma expressão matemática
function calcularExpressao($expressao)
{

    foreach ($expressao as $value) {
        // Verifica se a expressão é válida
        if (!validarExpressao($value)) {
            return 'Expressão inválida';
        }

        // Tenta avaliar a expressão e lidar com possíveis erros
        try {
            // Usa a função eval() de forma segura
            // $resultado = @eval ("return $expressao;");
            $resultado = @eval ("return $value;");
            
            if ($resultado === FALSE) {
                throw new Exception('Erro na expressão');
            }

            $resultExpressao[] = $resultado;

        } catch (Exception $e) {
            // return 'Erro: ' . $e->getMessage();
            $resultExpressao[] = $e->getMessage();

        } catch (Error $e) {
            $resultExpressao[] = $e->getMessage();
        }
    }
    return $resultExpressao;
}




