<?php
/**
 * Created by PhpStorm.
 * User: Dakshyani
 * Date: 4/8/2017
 * Time: 4:53 PM
 */

namespace TripSorter\Person;

use TripSorter\TransportableAbstract\TransportableAbstract as PersonAbstract;

class Person extends PersonAbstract {

    protected $name;

    function __construct($name) {
        $this->name = $name;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}