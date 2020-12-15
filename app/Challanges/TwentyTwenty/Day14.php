<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;
use drupol\phpermutations\Generators\Permutations;

class Day14 extends ChallangeBase
{
    private $input;

    private $mem  = [];

    private $mask = [
        'ones'  => '',
        'zeros' => ''
    ];

    public function __construct($input)
    {
        $this->input = explode("\n", $input);
//        $this->input = [
//            'mask = 000000000000000000000000000000X1001X',
//            'mem[42] = 100',
//            'mask = 00000000000000000000000000000000X0XX',
//            'mem[26] = 1'
//        ];
    }

    public function handlePart1()
    {
        foreach($this->input as $line) {
            if(preg_match('/^mask = ([01X]+)$/', $line, $matches)) {
                $this->setMask($matches[1]);
                continue;
            }

            preg_match_all('/(\d+)/', $line, $matches);

            $pointer = intval($matches[1][0]);
            $val     = intval($matches[1][1]);

            $val = $this->mask['ones']  | $val;
            $val = $this->mask['zeros'] & $val;

            $this->mem[$pointer] = $val;
        }

        return array_sum(array_values($this->mem));
    }

    private function setMask($mask)
    {
        $this->mask = [
            'ones'  => intval(str_replace('X', '0', $mask), 2),
            'zeros' => intval(str_replace('X', '1', $mask), 2)
        ];
    }

    public function handlePart2()
    {
        $this->mask = '';
        $this->mem  = [];

        foreach($this->input as $line) {
            if(preg_match('/^mask = ([01X]+)$/', $line, $matches)) {
                $this->mask = $matches[1];
                continue;
            }

            preg_match_all('/(\d+)/', $line, $matches);

            $pointer = intval($matches[1][0]);
            $val     = intval($matches[1][1]);

            $first_mask = [
                'ones'  => intval(str_replace('X', '0', $this->mask), 2),
                'zeros' => intval(str_replace('X', '1', $this->mask), 2)
            ];

            $pointer = $first_mask['zeros'] & ($first_mask['ones'] | $pointer);

            foreach($this->getPointers($pointer) as $pointer) {
                $this->mem[$pointer] = $val;
            }
        }

        return array_sum(array_values($this->mem));
    }

    private function getPointers($pointer)
    {
        $pointers = [];

        $mask    = str_split($this->mask);
        $address = str_split(str_pad(decbin($pointer), count($mask), '0', STR_PAD_LEFT));
        $result  = '';

        for($i = 0; $i < count($mask); $i++) {
            if($mask[$i] === 'X') {
                $result .= 'X';
                continue;
            }

            if($mask[$i] === '1' || $address[$i] === '1') {
                $result .= '1';
                continue;
            }

            $result .= '0';
        }

        $bit_length = substr_count($result, 'X');

        for($i = 0; $i <= intval(str_repeat('1', $bit_length), 2); $i++) {
            $p = '';
            $bits = str_split(str_pad(decbin($i), $bit_length, '0', STR_PAD_LEFT));

            foreach(str_split($result) as $char) {
                if($char === 'X') {
                    $p .= array_shift($bits);
                } else {
                    $p .= $char;
                }
            }

            $pointers[] = intval($p, 2);
        }

        return $pointers;
    }
}
