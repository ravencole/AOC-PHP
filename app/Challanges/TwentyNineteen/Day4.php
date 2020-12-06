<?php

namespace App\Challanges\TwentyNineteen;

use App\Challanges\ChallangeBase;

class Day4 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = array_map('intval',explode("-", $input));
    }

    public function handlePart1()
    {
        $count = 0;

        for($i = $this->input[0]; $i < $this->input[1]; $i++) {
            $consecutive_nums  = false;
            $incrementing_nums = true;

            $str = "{$i}";

            for($j = 1; $j < strlen($str); $j++) {
                if($str[$j] === $str[$j - 1])
                    $consecutive_nums = true;
                if((int) $str[$j] < (int) $str[$j - 1])
                    $incrementing_nums = false;
            }

            if($consecutive_nums && $incrementing_nums)
                $count++;
        }

        return $count;
    }

    public function handlePart2()
    {
        $count = 0;

        for($i = $this->input[0]; $i < $this->input[1]; $i++) {
            $consecutive_nums  = false;
            $incrementing_nums = true;

            $str = "{$i}";

            for($j = 1; $j < strlen($str); $j++) {
                dd('/([^'.$j.']|^)['.$j.']{2}([^'.$j.']|$)/');
                if(preg_match('/([^'.$j.']|^)['.$j.']{2}([^'.$j.']|$)/', $str))
                    $consecutive_nums = true;
                if((int) $str[$j] < (int) $str[$j - 1])
                    $incrementing_nums = false;
            }

            if($consecutive_nums && $incrementing_nums)
                $count++;
        }

        return $count;
    }
}
