<?php
/**
 * Created by PhpStorm.
 * User: Dakshyani
 * Date: 4/8/2017
 * Time: 4:47 PM
 */

namespace TripSorter\CommonCard;

use TripSorter\CardAbstract\CardAbstract as CardAbstract;

class CommonCard extends CardAbstract
{
    protected $source;
    protected $destination;
    protected $vehicle;
    protected $seat;
    protected $gate;

    /**
     * Constructor for the CommonCard class.
     * @param array $card
     */
    function __construct(array $card) {
        $this->source       = $card['source'];
        $this->destination  = $card['destination'];
        $this->vehicle      = $card['vehicle'];
        $this->seat         = $card['seat'];
        $this->gate         = $card['gate'];

        return $this;
    }

    /**
     * @param string $property
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}