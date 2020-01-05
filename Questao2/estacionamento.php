<?php

/**A resolução foi feita em apenas um arquivo para facilitar a visualização.
 * O correto seria dividir cada classe em um arquivo separado e o fluxo instanciar as classes.
 * A estilização foi feita utilizando tags depreciadas apenas para melhor visualização e simplificação.
 */

class Veiculo {
  protected $tipoVeiculo;
  protected $modelo;
  protected $placa;
  protected $vagasNecessarias = 1;

  function __construct($tipoVeiculo, $modelo, $placa, $vagasNecessarias) {
    $this->setVeiculo($tipoVeiculo, $modelo, $placa, $vagasNecessarias);
  }

  public function getVeiculo(){
    return 'Modelo: '.$this->modelo.' | Placa: '.$this->placa.' | Vagas Necessárias: '.$this->vagasNecessarias;
  }

  public function getPlaca(){
    return $this->placa;
  } 
  
  public function getVagasNecessarias(){
    return $this->vagasNecessarias;
  } 

  private function setVeiculo($tipoVeiculo, $modelo, $placa, $vagasNecessarias){
    $this->tipoVeiculo = $tipoVeiculo;
    $this->modelo = $modelo;
    $this->placa = $placa;
    $this->vagasNecessarias = $vagasNecessarias;
  }
}

class Carro extends Veiculo {
  
    protected $tipoVeiculo = 'Carro';

    function __construct($modelo, $placa){
      $this->modelo = $modelo;
      $this->placa = $placa;
    }
}
class Caminhao extends Veiculo {
  
    protected $tipoVeiculo = 'Caminhão';
    protected $vagasNecessarias = '3';

    function __construct($modelo, $placa){
      $this->modelo = $modelo;
      $this->placa = $placa;
    }
}

class Estacionamento {

  private $veiculosEstacionados = array();
  private $vagasDisponiveis = 10;

  private function getVagasDisponiveis(){
    return $this->vagasDisponiveis;
  }

  public function estacionar($veiculo){
    if($this->getVagasDisponiveis()){
      array_push($this->veiculosEstacionados, $veiculo);
      $this->vagasDisponiveis -= $veiculo->getVagasNecessarias();
      echo '<strong>[ '.$veiculo->getVeiculo().' ]</strong> <font color="green">estacionou.</font><br>';
      echo $this->statusEstacionamento();
    }else{
      echo 'Não existem vagas disponíveis para o veículo <strong><font color="red">[ '.$veiculo->getVeiculo().' ]</font></strong><br>';
      echo $this->statusEstacionamento();
    }
  }

  public function sair($veiculo){
    $veiculoExiste = $this->carroEstaEstacionado($veiculo);
    
    if($veiculoExiste){
      array_splice($this->veiculosEstacionados, $veiculoExiste, 1);
      $this->vagasDisponiveis += $veiculo->getVagasNecessarias();
      echo 'O carro <strong>[ '. $veiculo->getVeiculo() .' ]</strong> <font color="red">saiu do estacionamento.</font><br>'; 
    }
    else
      echo '<font color="orange">O carro <strong>[ '. $veiculo->getVeiculo() .' ]</strong> não está estacionado aqui.</font><br>';  

      echo $this->statusEstacionamento();
  }

  protected function statusEstacionamento(){
    return '<font color="blue"><strong> [' .count($this->veiculosEstacionados).' carros estão estacionados no momento. || '.$this->vagasDisponiveis. ' vagas disponíveis. ]</strong></font><br><br>';
  }

  protected function carroEstaEstacionado($veiculo){
    foreach ($this->veiculosEstacionados as $key => $value) {
      if ($value->getPlaca() === $veiculo->getPlaca())
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
$carro5 = new Carro('C3','CIT123');
$caminhao1 = new Caminhao('SCANIA','CAM123');
$caminhao2 = new Caminhao('VOLKS','CAM456');
$caminhao3 = new Caminhao('IVECO','CAM789');


$estacionamento->estacionar($carro1);
$estacionamento->estacionar($carro2);
$estacionamento->estacionar($carro3);
$estacionamento->estacionar($carro4);

$estacionamento->estacionar($caminhao1);
$estacionamento->estacionar($caminhao2);
$estacionamento->estacionar($caminhao3);

$estacionamento->estacionar($carro4);

$estacionamento->sair($carro2);
$estacionamento->sair($caminhao2);
$estacionamento->sair($caminhao3);
$estacionamento->estacionar($carro2);

?>