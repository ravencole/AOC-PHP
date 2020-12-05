<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day2 extends ChallangeBase
{
    private $input;

    private $regex = '/^(\d+)-(\d+) (\w): (\w+)$/';

    public function __construct($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        $count = 0;

        foreach($this->input as $line) {
            preg_match($this->regex, $line, $matches);

            $len = count(explode($matches[3], $matches[4])) - 1;

            if(
                $len >= (int) $matches[1] &&
                $len <= (int) $matches[2]
            )
                $count++;
        }

        return $count;
    }

    public function handlePart2()
    {
        $count = 0;

        foreach($this->input as $line) {
            preg_match($this->regex, $line, $matches);

            if(
                $matches[4][(int) $matches[1] - 1] === $matches[3] xor
                $matches[4][(int) $matches[2] - 1] === $matches[3]
            )
                $count++;
        }

        return $count;
    }
}
