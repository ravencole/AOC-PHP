<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day4 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = trim($input);
    }

    public function handlePart1()
    {
        $count = 1;

        while(true)
            if(
                substr(md5("{$this->input}{$count}"), 0, 5) === '00000'
            )
                return $count;
            else
                $count++;
    }

    public function handlePart2()
    {
        $count = 1;

        while(true)
            if(
                substr(md5("{$this->input}{$count}"), 0, 6) === '000000'
            )
                return $count;
            else
                $count++;
    }
}
