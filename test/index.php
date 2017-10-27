<?php
require_once '../vendor/autoload.php';
/**
 * Created by PhpStorm.
 * User: Dakshyani
 * Date: 4/8/2017
 * Time: 5:08 PM
 */

echo 'Trip Sorter Test';

use TripSorter\CardFactory\CardFactory;
use TripSorter\CardAbstract\CardAbstract;
use TripSorter\Person\Person;
use TripSorter\TransportableAbstract\TransportableAbstract;
use TripSorter\modules\travel\Travel;

/**
 * $passenger could be an instance of Person
 * or an array which contains Person instances.
 */
$passengers = array(new Person('Deb'), new Person('Dakshyani'));

echo "<br/>".' Passengers tests:'."<br/>";

foreach ($passengers as $key => $passenger) {
    if ($passenger instanceof TransportableAbstract) {
        echo 'PASS: ' . $passenger->name . ' should extends TransportableAbstract' . "<br/>";
    }
    else {
        throw new Exception($passenger->name . ' should extends TransportableAbstract');
    }
}

/**
 * Tickets an array of Cards.
 * If you dont define 'type' member for the array the tickets will create by CommonCard class.
 */
$test_tickets = array(
    array(
        'source' => 'Madrid Metro Station',
        'destination' => 'Barcelona Metro Station',
        'vehicle' => '78A train',
        'seat' => '45B',
        'gate' => null
    ),
    array(
        'source' => 'Barcelona Metro Station',
        'destination' => 'Gerona Airport',
        'vehicle' => 'Airport Bus',
        'seat' => null,
        'gate' => null
    ),
    array(
        'source' => 'Gerona Airport',
        'destination' => 'Stockholm Airport',
        'vehicle' => 'Flight SK455',
        'seat' => '3A',
        'gate' => '45B'
    ),
    array(
        'source' => 'Stockholm Airport',
        'destination' => 'New York JFKS Airport',
        'vehicle' => 'Flight SK22',
        'seat' => '7B',
        'gate' => '22'
    )
);

$tickets = array();
foreach ($test_tickets as $t) {
    array_push($tickets, CardFactory::create($t));
}

echo "<br/>".' Boarding Cards tests: '."<br/>";

if (!is_array($tickets)) {
    throw new Exception("Tickets should be an array which contains a kind of Card object by extending CardAbstract");
}

foreach ($tickets as $key => $ticket) {
    if ($ticket instanceof CardAbstract) {
        echo 'PASS: ' ."<br/>". $ticket->source . ' to ' . $ticket->destination . ' card should extends CardAbstract' . "<br/>";
    }
    else {
        throw new Exception($ticket->source . ' to ' . $ticket->destination . ' card should extends CardAbstract');
    }
}

/**
 * Create a Travel class and sort boarding cards.
 * Boarding cards should be in correct order
 */

$travel = new Travel($passengers, $tickets);
$route = $travel->sortTickets()->getTickets();
$passenger = $travel->getPassengers();

/**
 * $passangers should be "Deb, Dakshyani, "
 */
echo "<br/>" . '- Result test for passengers:' . "<br/>";

if ($passenger != 'Deb, Dakshyani, ') {
    echo 'ERROR: $passenger should be "Deb, Dakshyani, "' . "<br/>" ;
}
else {
    echo 'PASS: $passenger should be "Deb, Dakshyani, "' . "<br/>";
}

echo "<br/>" . '- Order test result for boarding cards:' . "<br/>";

for ($i=0; $i < count($route); $i++) {

    $next = isset($route[$i+1]) ? $route[$i+1]->source : $route[$i]->destination;

    if ($route[$i]->destination == $next) {
        echo 'PASS: ' . $route[$i]->source . ' to ' . $route[$i]->destination . ' by ' . $route[$i]->vehicle;
        echo ($route[$i]->gate) ? ', gate ' . $route[$i]->gate : '';
        echo ($route[$i]->seat) ? ', seat ' . $route[$i]->seat : '';
        echo "<br/>";
    }
    else {
        echo 'ERROR: ' . $route[$i]->source . ' to ' . $route[$i]->destination . ' by ' . $route[$i]->vehicle;
        echo ($route[$i]->gate) ? ', gate ' . $route[$i]->gate : '';
        echo ($route[$i]->seat) ? ', seat ' . $route[$i]->seat : '';
        echo "<br/>";
    }
    if ($i == count($route) -1 ) {
        echo 'PASS: You arrived to final destination.' . "<br/>";
        break;
    }
}
