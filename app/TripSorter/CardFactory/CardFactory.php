<?php
/**
 * Created by PhpStorm.
 * User: Dakshyani
 * Date: 4/8/2017
 * Time: 4:45 PM
 */

namespace TripSorter\CardFactory;

use TripSorter\CommonCard\CommonCard;
use \Exception;

abstract class CardFactory
{
    public static function create($card) {

        // use CommonCard class if type is not setted.
        if (!isset($card['type'])) {
            return new CommonCard($card);
        }
        else {
            // then use the type like PlaneCard, BusCard, MetroCard, TaxiCard
            try {
                return new $card['type'] . 'Card';
            }
            catch (Exception $e) {
                throw new Exception($card['type'] . 'Card' . ' class not found! ' . $e);
            }
        }
    }
}