<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day9 extends ChallangeBase
{
    public $mustRunBothChallanges = true;

    private $input;
    private $result;

    public function __construct($input)
    {
        $this->input = array_map('intval', explode("\n", $input));
    }

    public function handlePart1()
    {
        $index = 25;
        while(true) {
            $preamble = array_slice($this->input, $index - 25, $index);
            $curr     = $this->input[$index + 1];

            for($i = 0; $i < count($preamble); $i++)
                for($j = 0; $j < count($preamble); $j++)
                    if($preamble[$i] + $preamble[$j] === $curr) {
                        $index++;
                        continue 3;
                    }

            return $this->result = $curr;
        }
    }

    public function handlePart2()
    {
        $needle = $this->result;

        for($i = 0; $i < count($this->input); $i++) {
            $length = 1;
            $set = [$this->input[$i]];

            while(($sum = array_sum($set)) <= $needle)
                if($sum < $needle)
                    $set = array_slice($this->input, $i, ++$length);
                else
                    return min($set) + max($set);
        }
    }
}
