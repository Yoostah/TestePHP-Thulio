<?php

function calculoRaizes($a, $b=0, $c=0){
  if ($a == 0) return 'Não é uma equação do segundo grau!';

  $delta = ($b*$b)-((4*$a)*$c);

  if ($delta < 0) {
    return 'Não existem raizes para a equação pois o valor de delta é negativo!';
  } else {
    $x1 = (-$b + sqrt ($delta)) / (2 * $a);
    $x2 = (-$b - sqrt ($delta)) / (2 * $a);

    if($delta == 0) return $x1.' é a única raiz para a equação pois o valor de delta é zero!';

    return 'As raizes são '.$x1.' e '.$x2;
  }
}

echo calculoRaizes(5, -1, 0);

?>

