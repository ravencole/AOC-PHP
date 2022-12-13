<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day3 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        return array_reduce($this->input, fn($a, $l) => $a + array_reduce(array_unique(array_intersect(str_split(substr($l, 0, strlen($l) / 2)), str_split(substr($l, strlen($l) / 2)))), fn($a, $b) => $a + (strpos('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $b) + 1), 0), 0);
    }

    public function handlePart2()
    {
    }
}
