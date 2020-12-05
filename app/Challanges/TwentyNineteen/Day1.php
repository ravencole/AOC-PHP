<?php

namespace App\Challanges\TwentyNineteen;

use App\Challanges\ChallangeBase;

class Day1 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = array_map('intval',explode("\n", $input));
    }

    public function handlePart1()
    {
        $that = $this;

        return array_reduce($this->input, function($a, $b) use ($that) {
            return $a + $that->fuelCalc($b);
        }, 0);
    }

    public function handlePart2()
    {
        $that = $this;
        $fuel = array_map(function($a) use ($that) {
           return $that->fuelCalc($a);
        }, $this->input);

        $total = array_sum($fuel);

        while(max($fuel) > 0)
            for($i = 0; $i < count($fuel); $i++)
                $total += $fuel[$i] = $this->fuelCalc($fuel[$i]);

        return $total;
    }

    public function fuelCalc($mass)
    {
        return floor($mass / 3) - 2;
    }

}
