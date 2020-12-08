<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day8 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        return $this->runProgram($this->input)['acc'];
    }

    public function handlePart2()
    {
        $programs = [];

        for($i = 0; $i < count($this->input); $i++) {
            [$op, $arg] = explode(' ',$this->input[$i]);

            if(in_array($op, ['nop', 'jmp'])) {
                $new_program = $this->input;
                $new_program[$i] = ($op === 'nop' ? 'jmp' : 'nop') . " {$arg}";
                $programs[] = $new_program;
            }
        }

        foreach($programs as $program) {
            $result = $this->runProgram($program);

            if($result['halt'])
                return $result['acc'];
        }
    }

    private function runProgram($program)
    {
        $instruction = 0;
        $acc         = 0;
        $seen        = [];

        while(true) {
            if($instruction >= count($program))
                return [
                    'halt' => true,
                    'acc'  => $acc
                ];

            [$op, $arg] = explode(' ',$program[$instruction]);

            if(in_array($instruction, $seen))
                return [
                    'halt' => false,
                    'acc'  => $acc
                ];
            else
                $seen[] = $instruction;

            if($op === 'nop') {
                $instruction++;
                continue;
            }

            if($op === 'acc') {
                $instruction++;
                $acc += intval($arg);
                continue;
            }

            $instruction += intval($arg);
        }
    }
}
