<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day4 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        return array_reduce($this->input, function($a, $line) {
            [
                $pair_1, $pair_2
            ] = array_map(fn ($a) => array_map('intval',explode('-', $a)),explode(',', $line));

            return ($pair_1[0] >= $pair_2[0] && $pair_1[1] <= $pair_2[1])
                || ($pair_2[0] >= $pair_1[0] && $pair_2[1] <= $pair_1[1])
                ? $a + 1 : $a;
        }, 0);
    }

    public function handlePart2()
    {
        return array_reduce($this->input, function($a, $line) {
            [
                $pair_1, $pair_2
            ] = array_map(fn ($a) => array_map('intval',explode('-', $a)),explode(',', $line));

            return ($pair_2[0] >= $pair_1[0] && $pair_2[0] <= $pair_1[1])
                || ($pair_1[0] >= $pair_2[0] && $pair_1[0] <= $pair_2[1])
                || ($pair_1[1] >= $pair_2[0] && $pair_1[1] <= $pair_2[1])
                || ($pair_2[1] >= $pair_1[0] && $pair_2[1] <= $pair_1[1])
                ? $a + 1 : $a;
        }, 0);
    }
}
