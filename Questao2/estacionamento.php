<?php

/**A resolução foi feita em apenas um arquivo para facilitar a visualização.
 * O correto seria dividir cada classe em um arquvi separado e o fluxo instanciar as classes.
 */

class Carro {
  private $modelo;
  private $placa;

  function __construct($modelo, $placa) {
    $this->setCarro($modelo, $placa);
  }

  public function getCarro(){
    return 'Modelo: '.$this->modelo.' | Placa: '.$this->placa;
  }

  private function setCarro($modelo, $placa){
    $this->modelo = $modelo;
    $this->placa = $placa;
  }
}

class Estacionamento {

  private $carrosEstacionados = array();

  public function estacionar($carro){
    array_push($this->carrosEstacionados, $carro);
    echo $carro->getCarro().' estacionou.<br>';
    echo $this->statusEstacionamento();
  }

  public function sair($carro){

  }

  protected function statusEstacionamento(){
    return count($this->carrosEstacionados).' carros estão estacionados no momento.<br><br>';
  }

}
$estacionamento = new Estacionamento();

$carro1 = new Carro('Gol','GOL123');
$carro2 = new Carro('Palio','PAL123');
$carro3 = new Carro('Fiesta','FIE123');
$carro4 = new Carro('Focus','FOC123');

$estacionamento->estacionar($carro1);
$estacionamento->estacionar($carro2);
$estacionamento->estacionar($carro3);
$estacionamento->estacionar($carro4);
?>