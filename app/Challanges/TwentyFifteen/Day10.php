<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day10 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = trim($input);
    }

    public function handlePart1()
    {
        return $this->run(40);
    }

    public function handlePart2()
    {
        return $this->run(50);
    }

    private function run(int $amount = 1)
    {
        $code    = $this->input;
        $count   = 0;

        while($count < $amount) {
            $code = array_reduce(str_split($code), function($a, $b) {
                if(empty($a))
                    return "1{$b}";

                if($a[strlen($a) - 1] === $b)
                    $a[strlen($a) - 2] = intval($a[strlen($a) - 2]) + 1;
                else
                    $a .= "1{$b}";

                return $a;
            }, '');

            $count++;
        }

        return strlen($code);
    }
}
