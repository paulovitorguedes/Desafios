<?php

$values = array();
$result = array();

$fileName = "d12.txt";
if (file_exists($fileName)) {

    $file = fopen($fileName, 'r');
    while (!feof($file)) {
        $values[] = fgets($file);
    }

    fclose($file);
    echo var_dump($values);

    $final = potencia($values);
    echo var_dump($final);
}



function potencia(array $values) :array
{
    foreach ($values as $value) {

        if ($value > 1) {

            $val = 2;
            $count = 1;

            while ($val < $value) {
                $val *= 2;
                $count++;
            }

            $val == $value ? $result[] = "$value True $count" : $result[] = "$value False";

        } else $value == 1 ? $result[] = "$value True 0" : $result[] = "$value False";
    }
    return $result;
}


