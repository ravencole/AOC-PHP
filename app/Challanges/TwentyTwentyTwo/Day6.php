<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day6 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = trim(explode("\n", $input)[0]);
    }

    public function handlePart1()
    {
        $seq = str_split(substr($this->input, 0, 3));

        for($i = 3; $i < strlen($this->input) - 1; $i++) {
            $char = $this->input[$i];

            $tmp = [
                ...$seq,
                $char
            ];

            if(count(array_unique($tmp)) === 4) {
                return $i + 1;
            }

            $seq = [
                $tmp[1], $tmp[2], $char
            ];
        }
    }

    public function handlePart2()
    {
        $seq = str_split(substr($this->input, 0, 13));

        for($i = 13; $i < strlen($this->input) - 1; $i++) {
            $char = $this->input[$i];

            $tmp = [
                ...$seq,
                $char
            ];

            if(count(array_unique($tmp)) === 14) {
                return $i + 1;
            }

            $seq = [
                $tmp[1],
                $tmp[2],
                $tmp[3],
                $tmp[4],
                $tmp[5],
                $tmp[6],
                $tmp[7],
                $tmp[8],
                $tmp[9],
                $tmp[10],
                $tmp[11],
                $tmp[12],
                $char,
            ];
        }
    }
}
