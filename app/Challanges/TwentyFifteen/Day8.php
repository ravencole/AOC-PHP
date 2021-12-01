<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day8 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n",trim($input));
    }

    public function handlePart1()
    {
        return array_reduce($this->input, function($a, $b) {
            $a += strlen($b);
            eval("\$a -= strlen($b);");

            return $a;
        }, 0);
    }

    public function handlePart2()
    {
        return array_reduce($this->input, function($a, $b) {
            return  $a + strlen(addslashes($b)) + 2 - strlen($b);
        }, 0);
    }
}
