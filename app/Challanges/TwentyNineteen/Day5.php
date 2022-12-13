<?php

namespace App\Challanges\TwentyNineteen;

use App\Challanges\ChallangeBase;

class Day5 extends ChallangeBase
{
    public $input;

    public function __construct($input, array $extras)
    {
        $this->input = trim($input);
    }

    public function _setup($input)
    {
    }

    public function handlePart1()
    {
        dd($this->input);
    }

    public function handlePart2()
    {
    }
}
