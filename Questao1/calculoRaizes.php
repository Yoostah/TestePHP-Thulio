<?php

function calculoRaizes($a, $b, $c = 0){
  $delta = ($b*$b)-((4*$a)*$c);
  $x1 = (-$b + sqrt ($delta)) / (2 * $a);
  $x2 = (-$b - sqrt ($delta)) / (2 * $a);
  return 'As raizes são '.$x1.' e '.$x2;
}

echo calculoRaizes(1, 0, 6);

?>

