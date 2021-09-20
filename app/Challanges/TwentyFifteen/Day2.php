<?php

namespace App\Challanges\TwentyFifteen;

use Illuminate\Support\Arr;

use App\Challanges\ChallangeBase;

class Day2 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = $input;
    }

    public function handlePart1()
    {
        return array_sum(array_map(function($line) {
            $vals = array_map('intval', explode('x', $line));

            sort($vals);

            [
                $h,
                $w,
                $l
            ] = $vals;

            return (2*$l*$w + 2*$w*$h + 2*$h*$l) + $h * $w;
        }, explode("\n", trim($this->input))));
    }

    public function handlePart2()
    {
        return array_sum(array_map(function($line) {
            $vals = array_map('intval', explode('x', $line));

            sort($vals);

            [
                $h,
                $w,
                $l
            ] = $vals;

            return (2*$h) + (2*$w) + ($h*$l*$w);
        }, explode("\n", trim($this->input))));
    }
}
