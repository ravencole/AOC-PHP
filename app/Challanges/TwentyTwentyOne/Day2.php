<?php

namespace App\Challanges\TwentyTwentyOne;

use App\Challanges\ChallangeBase;

class Day2 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        dd($this->input);
    }

    public function handlePart2()
    {
    }
}
