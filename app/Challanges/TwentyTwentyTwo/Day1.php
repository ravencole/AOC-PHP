<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day1 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        return max(array_values($this->beforeHandle()));
    }

    public function handlePart2()
    {
        $cals = $this->beforeHandle();

        rsort($cals);

        return $cals[0] + $cals[1] + $cals[2];
    }

    private function beforeHandle()
    {
        $cals = [
            0 => 0
        ];

        foreach($this->input as $line) {
            $amt = intval($line);

            if(! $amt) {
                $cals[] = 0;
            }
            else {
                $cals[count($cals) - 1] += $amt;
            }
        }

        return $cals;
    }
}
