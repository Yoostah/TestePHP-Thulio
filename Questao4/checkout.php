<?php 

class Flight{
  private $flightNumber;
  private $cia;
  private $departureAirport;
  private $arrivalAirport;
  private $departureTime;
  private $arrivalTime;
  private $valorTotal;
  private $extraServices;

  //Valor fixos dos serviços adicionais
  private $bagValue = 125.50;
  private $petValue = 100.00;

  public function __construct(
    string $flightNumber,
    string $cia,
    string $departureAirport,
    string $arrivalAirport,
    DateTime $departureTime,
    DateTime $arrivalTime,
    float $valorTotal,
    array $extraServices
  )
  {
    $this->flightNumber = $flightNumber;
    $this->cia = $cia;
    $this->departureAirport = $departureAirport;
    $this->arrivalAirport = $arrivalAirport;
    $this->departureTime = $departureTime;
    $this->arrivalTime = $arrivalTime;
    $this->extraServices = $this->setExtraServices($extraServices);
    $this->valorTotal = $valorTotal;
  }  

  public function getFlightNumber() 
  {
    return $this->flightNumber;
  }
  
  public function getCia() 
  {
    return $this->cia;
  }
  
  public function getDepartureAirport() 
  {
    return $this->departureAirport;
  }

  public function getArrivalAirport()
  {
    return $this->arrivalAirport;
  }

  public function getDepartureTime()
  {
    return $this->departureTime;
  }

  public function getArrivalTime()
  {
    return $this->arrivalTime;
  }

  public function getValorTotal()
  {
    $valorTotalComExtras = ($this->valorTotal + $this->getExtraServicesValue());
    return $valorTotalComExtras;
  }

  public function setExtraServices($servicesArray){
    $extraServices = array();
    if(count($servicesArray) > 0){
 
      foreach ($servicesArray as $key => $quantidade) {
        if($key === 'bag'){
          $extraServices['Bagagem Extra'] = [
            'Quantidade' => $quantidade,
            'Valor' => $quantidade * $this->bagValue
          ];
          

        }elseif($key === 'carry-on-pet'){
          $extraServices['Carga Viva'] = [
            'Quantidade' => $quantidade,
            'Valor' => $quantidade * $this->petValue
          ];

        }
      }

    }
    return $this->extraServices = $extraServices;
  }

  public function getExtraServices()
  {
    if(count($this->extraServices) > 0)
      return $this->extraServices;
    else
     return false; 
  }

  public function getExtraServicesValue()
  { 
    $totalExtraServiceValue = 0.00;
    foreach ($this->extraServices as $key => $value) {
      $totalExtraServiceValue += $value['Valor'];
    } 
    return $totalExtraServiceValue;
  }
}

class Checkout
{
  private $flightOutbound;
  private $flightInbound;
  
  public function __construct(Flight $flightOutbound, Flight $flightInbound = null)
  {
    $this->flightOutbound = $flightOutbound;
    $this->flightInbound = $flightInbound;
  }
  
  public function generateExtract()
  {
    $valorTotal = $this->flightOutbound->getValorTotal();
    $flightDetailsOutbound = [
      'De' => $this->flightOutbound->getDepartureAirport(),
      'Para' => $this->flightOutbound->getArrivalAirport(),
      'Embarque' => $this->flightOutbound->getDepartureTime()->format('d/m/Y H:i'),
      'Desembarque' => $this->flightOutbound->getArrivalTime()->format('d/m/Y H:i'),
      'Cia' => $this->flightOutbound->getCia(),
      'Valor' => $this->flightOutbound->getValorTotal(),
      'Serviços Extras' => $this->flightOutbound->getExtraServices()
    ];
    
    $flightDetailsInbound = [];
    if (! is_null($this->flightInbound)) {
      $valorTotal += $this->flightInbound->getValorTotal();
      $flightDetailsInbound = [
        'De' => $this->flightInbound->getDepartureAirport(),
        'Para' => $this->flightInbound->getArrivalAirport(),
        'Embarque' => $this->flightInbound->getDepartureTime()->format('d/m/Y H:i'),
        'Desembarque' => $this->flightInbound->getArrivalTime()->format('d/m/Y H:i'),
        'Cia' => $this->flightInbound->getCia(),
        'Valor' => $this->flightInbound->getValorTotal(),
        'Serviços Extras' => $this->flightInbound->getExtraServices()
      ];
    }
    
    return (object) [
        'flightOutbound' => $flightDetailsOutbound,
        'flightInbound' => $flightDetailsInbound,
        'valorTotal' => $valorTotal
    ];
  }
}

$flightOutbound = new Flight(
'0001',
'GOL',
'GRU - Guarulhos',
'CON - Confins',
new DateTime('2020-01-01T15:00:00.012345Z'),
new DateTime('2020-01-01T18:00:00.012345Z'),
1500.00,
$extraServices = [
  'bag' => 1,
  'carry-on-pet' => 2
]
);


$flightInbound= new Flight(
'0002',
'GOL',
'CON - Confins',
'GRU - Guarulhos',
new DateTime('2020-01-04T15:00:00.012345Z'),
new DateTime('2020-01-04T18:00:00.012345Z'),
1500.00,
array()
);

$checkout = new Checkout($flightOutbound);

echo '<pre>';
print_r ($checkout->generateExtract());
echo '</pre>';
?>