<?php

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
    // Verifica se a expressão é válida
    if (!validarExpressao($expressao)) {
        return 'Expressão inválida';
    }

    // Tenta avaliar a expressão e lidar com possíveis erros
    try {
        // Usa a função eval() de forma segura
        // $resultado = @eval ("return $expressao;");
        $resultado = @eval ("return $expressao;");
        if ($resultado === FALSE) {
            throw new Exception('Erro na expressão');
        }
        return $resultado;
    } catch (Exception $e) {
        return 'Erro: ' . $e->getMessage();
    
    } catch (Error $e) {
        echo var_dump($e);
        echo $e->getMessage();
    }

}

// Recebe a variável 'conta' da query string
// $expressao = $_GET['conta'] ?? '';
$expressao = "5 + 1";
$expressao =  preg_replace('/[^0-9+\-.*\/()%]/', '', $expressao);

// Verifica se a expressão foi fornecida
if (!empty($expressao)) {
    // Calcula e exibe o resultado da expressão
    $resultado = calcularExpressao($expressao);
    echo "O resultado da expressão $expressao é: $resultado";
} else {
    echo "Por favor, forneça uma expressão para calcular.";
}




