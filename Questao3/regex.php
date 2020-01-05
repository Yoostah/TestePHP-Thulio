<?php

$string = 
'Melhor preço sem escalas R$ 1.367,10(1)
Melhor preço com escalas R$ 994,10 (1)
R$100.121.121,5
1 - Incluindo todas as taxas.';

/**
 *  - (R\$\s?) - String que tenha um R seguido de um $ e com um espaço opcional
 *  - \d{1,3}(.?\d{3})* - String com 1 a 3 digitos seguidos por um ponto, que pode ser opcional. 
 *                        Caso existam mais digitos após o ponto, devem ser 3
 *  - (\,\d\d)? - String iniciada com uma virgula e com 2 digitos após a a virgula. Toda esta regra é opcional
 */
preg_match_all('/(R\$\s?)+\d{1,3}(.?\d{3})*(\,\d\d)?/', $string ,$matches);

var_dump($matches[0]);
?>