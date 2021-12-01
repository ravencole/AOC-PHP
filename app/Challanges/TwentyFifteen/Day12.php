<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day12 extends ChallangeBase
{
    public $input = '';

    public function _setup($input)
    {
        $this->input = trim($input);
    }

    public function handlePart1()
    {
        preg_match_all('/-?\d+/', $this->input, $matches);

        return array_reduce($matches[0], function($a, $b) {
           return $a + intval($b);
        }, 0);
    }

    public function handlePart2()
    {
        $obj = json_decode($this->input, true);

        // Recursive shit, ill do it another time

        dd($obj);
    }
}
