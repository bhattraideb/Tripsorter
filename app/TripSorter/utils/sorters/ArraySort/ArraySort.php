<?php
/**
 * Created by PhpStorm.
 * User: Dakshyani
 * Date: 4/8/2017
 * Time: 5:03 PM
 */

namespace TripSorter\utils\sorters\ArraySort;

use TripSorter\utils\interfaces\SortInterface\SortInterface as SortInterface;
use \Exception;

class ArraySort implements SortInterface {

    protected static $items;
    protected static $arranged = array();
    protected static $tmp = array();
    public static function sort($items){

        self::$items = $items;

        // take an element from $items ant push it to self::$arranged array
        if (count(self::$arranged) == 0) {
            array_push(self::$arranged, array_shift(self::$items));
        }

        foreach (self::$items as $key => $item) {
            if (!$item->source || !$item->destination) {
                throw new Exception("source and destination members are mandatory");
            }

            $source = reset(self::$arranged);
            $source = $source->source;

            $destination = end(self::$arranged);
            $destination = $destination->destination;

            if ($destination == $item->source || $source == $item->destination) {

                if ($item->source == $destination) {
                    array_push(self::$arranged, $item);
                }

                if ($item->destination == $source) {
                    array_unshift(self::$arranged, $item);
                }

                if (isset(self::$tmp[$key])) {
                    unset(self::$tmp[$key]);
                }

            }
            else {
                array_push(self::$tmp, $item);
            }
        }

        if (count(self::$tmp) > 0) {
            self::sort(self::$tmp);
        }

        return self::$arranged;
    }

}