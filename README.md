# Tripsorter

PROJECT SCOPE:

1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
Baggage drop at ticket counter 344.
4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
Baggage will we automatically transferred from your last leg.
5. You have arrived at your final destination.

REQUOREMENT:
"php": ">=5.6"
"phpunit/phpunit": "6.*"
"psr-4"

Running application:
1- Extract files and put the donloaded files into project folder.
2- run index.php file as localhost/tripSortet/index.php in my case.
  
 Triggering test 
----------------------------------------------
$ php test/index.php

//** Example Usage
----------------------------------------------

//** Include bootstrap file.
    require_once 'vendor/autoload.php';
	
	//** Include classes.
	
	use TripSorter\CardFactory\CardFactory;
	use TripSorter\CardAbstract\CardAbstract;
	use TripSorter\Person\Person;
	use TripSorter\TransportableAbstract\TransportableAbstract;
	use TripSorter\modules\travel\Travel;

//** Create two tickets
    $tickets = array(
      CardFactory::create(array(
        'source' => 'Madrid Metro Station',
        'destination' => 'Barcelona Metro Station ',
        'vehicle' => '78A train',
        'seat' => '45B',
        'gate' => null
      )),
      CardFactory::create(array(
        'source' => 'Barcelona',
        'destination' => 'Gerona Airport',
        'vehicle' => 'Airport Bus',
        'seat' => null,
        'gate' => null
      )),
	  CardFactory::create(array(
        'source' => 'Gerona Airport',
        'destination' => 'Stockholm Airport',
        'vehicle' => 'Flight SK455',
        'seat' => '3A',
        'gate' => '45B'
      )),
	  CardFactory::create(array(
        'source' => 'Stockholm Airport',
        'destination' => 'New York JFKS Airport',
        'vehicle' => 'Flight SK22',
        'seat' => '7B',
        'gate' => '22'
      ))
    );

//** Create three passengers
    $passengers = array(
      new Person('Deb'), 
      new Person('Prasad'),
      new Person('Bhattarai')
    );

//** Give the correct order to the crowd
    $travel = new Travel($passengers, $tickets);
	$route = $travel->sortTickets()->getTickets();
	$passenger = $travel->getPassengers();
    
//***route will be an array of the ordered tickets. If you would like you can also get passengers by calling getPassengers() method like above.
