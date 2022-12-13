<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day5 extends ChallangeBase
{
    public $input;

    public array $stack = [];

    public function _setup($input)
    {
        $this->input = explode("\n", $input);

        $this->stack = [
            1 => 'NBDTVGZJ',
            2 => 'SRMDWPF',
            3 => 'VCRSZ',
            4 => 'RTJZPHG',
            5 => 'TCJNDZQF',
            6 => 'NVPWGSFM',
            7 => 'GCVBPQ',
            8 => 'ZBPN',
            9 => 'WPJ',
        ];
    }

    public function handlePart1()
    {
        return array_reduce(
            array_reduce($this->input, function($stack, $line) {
                preg_match('/^move (\d+) from (\d+) to (\d+)$/', $line, $matches);

                $amt  = intval($matches[1]);
                $from = intval($matches[2]);
                $to   = intval($matches[3]);

                $stack[$to  ] .= strrev(substr($stack[$from], strlen($stack[$from]) - $amt));
                $stack[$from]  = substr($stack[$from], 0, strlen($stack[$from]) - $amt);

                return $stack;
            }, $this->stack),
            fn($a, $b) => $a . $b[strlen($b) - 1],
            ''
        );
    }

    public function handlePart2()
    {
        return array_reduce(
            array_reduce($this->input, function($stack, $line) {
                preg_match('/^move (\d+) from (\d+) to (\d+)$/', $line, $matches);

                $amt  = intval($matches[1]);
                $from = intval($matches[2]);
                $to   = intval($matches[3]);

                $stack[$to  ] .= substr($stack[$from], strlen($stack[$from]) - $amt);
                $stack[$from]  = substr($stack[$from], 0, strlen($stack[$from]) - $amt);

                return $stack;
            }, $this->stack),
            fn($a, $b) => $a . $b[strlen($b) - 1],
            ''
        );
    }
}
