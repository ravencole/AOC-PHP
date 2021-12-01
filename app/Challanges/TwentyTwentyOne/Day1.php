<?php

namespace App\Challanges\TwentyTwentyOne;

use App\Challanges\ChallangeBase;

class Day1 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = array_map('intval', explode("\n", $input));
    }

    public function handlePart1()
    {
        $increases = 0;

        for($i = 1; $i < count($this->input); $i++)
            if($this->input[$i] > $this->input[$i - 1])
                $increases++;

        return $increases;
    }

    public function handlePart2()
    {
        $increases = 0;

        for($i = 3; $i < count($this->input); $i++)
            if(
                  $this->input[$i - 2] + $this->input[$i - 1] + $this->input[$i    ]
                > $this->input[$i - 3] + $this->input[$i - 2] + $this->input[$i - 1]
            )
                $increases++;

        return $increases;
    }
}
