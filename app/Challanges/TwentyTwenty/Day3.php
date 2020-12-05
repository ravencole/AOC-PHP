<?php

namespace App\Challanges\TwentyTwenty;

class Day3
{
    private $input;

    public function __construct($input)
    {
        $this->input = explode("\n", trim($input));
    }

    public function handlePart1()
    {
        return $this->runSlope(3,1);
    }

    public function handlePart2()
    {
        return (
            $this->runSlope(1, 1) *
            $this->runSlope(3, 1) *
            $this->runSlope(5, 1) *
            $this->runSlope(7, 1) *
            $this->runSlope(1, 2)
        );
    }

    public function runSlope($x_rate, $y_rate) {
        $trees = 0;
        $line_len = strlen($this->input[0]);

        for($y = 0, $x = 0; $y < count($this->input); $y+=$y_rate, $x+=$x_rate)
            if($this->input[$y][$x % $line_len] === '#')
                $trees++;

        return $trees;
    }
}
