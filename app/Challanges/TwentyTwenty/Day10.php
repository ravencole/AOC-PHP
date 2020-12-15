<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day10 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
//        $this->input = array_map('intval', explode("\n", $input));

        $this->input = [
            16,
            10,
            15,
            5,
            1,
            11,
            7,
            19,
            6,
            12,
            4
        ];

        sort($this->input);
    }

    public function handlePart1()
    {
        $input_length = count($this->input);

        $device_joltage = $this->input[$input_length - 1] + 3;

        $one_diff   = $this->input[0] === 1 ? 1 : 0;
        $three_diff = $this->input[0] === 3 ? 1 : 0;

        for($i = 0; $i < $input_length; $i++) {
            if($i + 1 === $input_length)
                continue;

            $diff = $this->input[$i + 1] - $this->input[$i];

            if($diff === 1)
                $one_diff++;
            elseif($diff === 3)
                $three_diff++;
        }

        $device_diff = $device_joltage - $this->input[$input_length - 1];

        if($device_diff === 1)
            $one_diff++;
        elseif($device_diff === 3)
            $three_diff++;

        return $one_diff * $three_diff;
    }

    public function handlePart2()
    {
    }
}
