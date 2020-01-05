<?php

/**A resolução foi feita em apenas um arquivo para facilitar a visualização.
 * O correto seria dividir cada classe em um arquvi separado e o fluxo instanciar as classes.
 */

class Carro {
  protected $modelo;
  protected $placa;

  function __construct($modelo, $placa) {
    $this->setCarro($modelo, $placa);
  }

  public function getCarro(){
    return 'Modelo: '.$this->modelo.' | Placa: '.$this->placa;
  }

  public function getPlaca(){
    return $this->placa;
  } 

  private function setCarro($modelo, $placa){
    $this->modelo = $modelo;
    $this->placa = $placa;
  }
}

class Estacionamento {

  private $carrosEstacionados = array();
  private $vagasDisponiveis = 5;

  private function getVagasDisponiveis(){
    return $this->vagasDisponiveis;
  }

  public function estacionar($carro){
    if($this->getVagasDisponiveis()){
      array_push($this->carrosEstacionados, $carro);
      $this->vagasDisponiveis--;
      echo '<strong>[ '.$carro->getCarro().' ]</strong> estacionou.<br>';
      echo $this->statusEstacionamento();
    }else{
      echo 'Não existem vagas disponíveis.<br>';
      echo $this->statusEstacionamento();
    }
  }

  public function sair($carro){
    $carroExiste = $this->carroEstaEstacionado($carro);
    
    if($carroExiste){
      array_splice($this->carrosEstacionados, $carroExiste, 1);
      $this->vagasDisponiveis++;
      echo 'O carro <strong>[ '. $carro->getCarro() .' ]</strong> saiu do estacionamento.<br>'; 
    }
    else
      echo 'O carro <strong>[ '. $carro->getCarro() .' ]</strong> não está estacionado aqui.<br>';  

      echo $this->statusEstacionamento();
  }

  protected function statusEstacionamento(){
    return '<strong> [' .count($this->carrosEstacionados).'/'.$this->vagasDisponiveis. ']</strong> carros estão estacionados no momento.<br><br>';
  }

  public function status(){
    print_r($this->carrosEstacionados);
  }

  protected function carroEstaEstacionado($carro){
    foreach ($this->carrosEstacionados as $key => $value) {
      if ($value->getPlaca() === $carro->getPlaca())
        return $key;    
    }

    return false;
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
$estacionamento->estacionar($carro1);
$estacionamento->estacionar($carro2);

$estacionamento->sair($carro2);
$estacionamento->sair($carro3);

?>