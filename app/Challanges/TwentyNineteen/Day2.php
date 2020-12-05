<?php

namespace App\Challanges\TwentyNineteen;

use App\Challanges\ChallangeBase;

class Day2 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = array_map('intval',explode(",", $input));
    }

    public function handlePart1()
    {
        return $this->runProgram(12,2);
    }

    public function handlePart2()
    {
        for($i = 0; $i < 100; $i++)
            for($j = 0; $j < 100; $j++)
                if($this->runProgram($i, $j) === 19690720)
                    return 100 * $i + $j;
    }

    private function runProgram($one, $two)
    {
        $instruction_set    = $this->input;
        $instruction_set[1] = $one;
        $instruction_set[2] = $two;

        $counter = 0;

        while (true) {
            $opCode = $instruction_set[$counter];
            $val1   = $instruction_set[$instruction_set[$counter + 1]];
            $val2   = $instruction_set[$instruction_set[$counter + 2]];
            $output = $instruction_set[$counter + 3];

            if ($opCode === 1)
                $instruction_set[$output] = $val1 + $val2;
            else if ($opCode === 2)
                $instruction_set[$output] = $val1 * $val2;
            else
                return $instruction_set[0];

            $counter = ($counter + 4) % count($instruction_set);

        }
    }
}
