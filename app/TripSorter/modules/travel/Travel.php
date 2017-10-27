<?php
/**
 * Created by PhpStorm.
 * User: Dakshyani
 * Date: 4/8/2017
 * Time: 4:50 PM
 */

namespace TripSorter\modules\travel;

use TripSorter\utils\sorters\ArraySort\ArraySort as TicketSort;
use TripSorter\CardAbstract\CardAbstract;
use TripSorter\Person\Person;
use \Exception;

class Travel
{
    /**
     * An unordered array of Card class.
     */
    public $tickets = null;

    /**
     * Instance(s) of Person class
     */
    public $passengers = null;

    /**
     * Constructor of the Travel
     * @param array $passengers An array of Person class.
     * @param array $tickets An array of unsorted passenger cards.
     * @return Travel
     */
    function __construct($passengers, $tickets) {
        $this->setTickets($tickets);
        $this->setPassengers($passengers);
        return $this;
    }

    /**
     * Returns a string of the passengers' name.
     * @return name of the passenger(s).
     */
    public function getPassengers() {
        $passengers = '';

        foreach ($this->passengers as $passenger) {
            $passengers .= $passenger->name . ', ';
        }
        return $passengers;
    }

    /**
     * Sets the passenger(s)
     * @param array $passengers
     * @return Travel
     */
    public function setPassengers(array $passengers) {
        foreach ($passengers as $passenger) {
            if (!$passenger instanceof Person) {
                throw new Exception("Passenger(s) should be a instance of the Person class");
            }
        }

        $this->passengers = $passengers;
        return $this;
    }

    /**
     * adds passenger(s) to the passengers list.
     * @param Person $passenger an instance of Person class.
     * @return Travel
     */
    public function addPassenger(Person $passenger) {

        if(is_array($this->passenger)) {
            array_push($this->passenger, $passenger);
        }

        if (is_null($this->passenger)) {
            $this->passenger = array($passenger);
        }

        return $this;
    }

    /**
     * returns an array of passenger cards.
     */
    public function getTickets() {
        return $this->tickets;
    }

    /**
     * Setter for tickets
     * @param array $tickets an array of unsorted passenger cards.
     * @return Travel
     */
    public function setTickets(array $tickets){

        foreach ($tickets as $ticket) {
            if (!$ticket instanceof CardAbstract) {
                throw new Exception("Cards should be an instance of CardAbstract class");
            }
        }

        $this->tickets = $tickets;
        return $this;
    }

    /**
     * Adds a ticket to the ticket stack.
     *
     * @param Card $ticket an instance of Card class.
     * @return Travel
     */
    public function addTicket(Card $ticket){
        if(is_array($this->tickets)) {
            array_push($this->tickets, $ticket);
        }

        if (is_null($this->tickets)) {
            $this->tickets = array($ticket);
        }

        return $this;
    }

    /**
     * Sorts tickets as ascended
     * @return Travel
     */
    public function sortTickets() {
        $this->tickets = TicketSort::sort($this->tickets);
        return $this;
    }

    /**
     * Sorts tickets as descended
     */
    public function descSortTickets(){
        // implement code
    }
}