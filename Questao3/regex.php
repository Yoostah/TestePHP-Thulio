<?php

$string = 
"Melhor preço sem escalas R$ 1.367(1)
Melhor preço com escalas R$ 994 (1)

1 - Incluindo todas as taxas.";

/**
 *  - (R\$\s?) - String que tenha um R seguido de um $ e com um espaço opcional
 *  - \d{1,3}(.?\d{3})* - String com 1 a 3 digitos seguidos por um ponto, que pode ser opcional. 
 *                        Caso existam mais digitos após o ponto, devem ser 3
 *  - (\,\d\d)? - String iniciada com uma virgula e com 2 digitos após a a virgula. Toda esta regra é opcional
 */
preg_match_all('/(R\$\s?)+\d{1,3}(.?\d{3})*(\,\d\d)?/', $string ,$matches);

$menor = 0;
foreach ($matches[0] as $match => $value) {
  
  $valor = preg_replace('/R\$\s?+/', '', $value);
  //Remoção de pontos e troca de virgulas por pontos para comparação de valores
  $valor = str_replace(',','.', str_replace('.','',$valor));

  if($valor < $menor || $menor == 0 ){   
      $menor = $valor;
  }  
}

echo 'Menor valor encontrado: R$ <strong>'.$menor.'</strong>';
?>