<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day13 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = explode("\n", $input);

        $this->earliest_departure = intval($this->input[0]);
        $this->schedule = array_reduce(explode(',',$this->input[1]), function($a,$b) {
           if($b !== 'x')
               $a[] = intval($b);
           return $a;
        }, []);
    }

    public function handlePart1()
    {
        $i = $this->earliest_departure;
        while(true) {
           foreach($this->schedule as $bus) {
               if($i % $bus === 0) {
                   return ($i - $this->earliest_departure) * $bus;
               }
           }
           $i++;
        }
    }

    public function handlePart2()
    {
        $buses = explode(',',$this->input[1]);
        $time  = 0;
        $inc   = (int) $buses[0];

        for($i = 1; $i < count($buses); $i++){
            if($buses[$i] == "x")
                continue;

            $first = 0;

            while(true) {
                $bus = (int) $buses[$i];

                if(floor(($time + $i) / $bus) === ($time + $i) / $bus) {
                    if($first === 0) {
                        if($i == sizeof($buses) - 1)
                            return $time;
                        $first = $time;
                    }
                    else {
                        $inc = $time - $first;
                        break;
                    }
                }

                $time += $inc;
            }
        }
    }
}
