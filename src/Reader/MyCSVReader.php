<?php

namespace Reader;

use League\Csv\Reader;

class MyCSVReader extends Reader {

    public function trimCSVData($csvData, $offset = null, $length = null)
    {
        return array_slice($csvData, $offset, $length);

    }

    public function roundNumbers(&$numbers = array(), $precision)
    {

        array_walk($numbers, function($value, $key){
            $value = round($value, 2);
        });

        return $numbers;
    }

}