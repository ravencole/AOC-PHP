<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day6 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = array_map(function($group) {
            return explode("\n", $group);
        }, preg_split("#\n\s*\n#Uis", trim($input)));
    }

    public function handlePart1()
    {
        return array_reduce($this->input, function($a, $b) {
            return $a + count(array_unique(array_reduce($b, function($c, $d) {
                return array_merge($c, str_split($d));
            }, [])));
        }, 0);
    }

    public function handlePart2()
    {
        $count = 0;

        foreach($this->input as $group) {
            $az_map = array_reduce($group, function($a, $b) {
                return array_merge($a, str_split($b));
            }, []);

            sort($az_map);

            preg_match_all('/(\w)\1{'. (count($group) - 1) .'}/', join('',$az_map), $matches);

            $count += count($matches[0]);
        }

        return $count;
    }
}
