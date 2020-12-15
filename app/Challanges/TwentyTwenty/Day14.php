<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day14 extends ChallangeBase
{
    private $input;

    private $mem  = [];

    private $mask = '';

    public function __construct($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        $mask = [];

        foreach($this->input as $line) {
            if(preg_match('/^mask = ([01X]+)$/', $line, $matches)) {
                $mask = [
                    'ones'  => intval(str_replace('X', '0', $matches[1]), 2),
                    'zeros' => intval(str_replace('X', '1', $matches[1]), 2)
                ];
                continue;
            }

            preg_match_all('/(\d+)/', $line, $matches);

            $pointer = intval($matches[1][0]);
            $val     = intval($matches[1][1]);

            $this->mem[$pointer] = $mask['zeros'] & ($mask['ones']  | $val);
        }

        return array_sum(array_values($this->mem));
    }

    public function handlePart2()
    {
        // Reset the memory
        $this->mem  = [];

        // Cycle through all of the lines
        foreach($this->input as $line) {
            // If we find a mask, overwrite this->mask with it
            if(preg_match('/^mask = ([01X]+)$/', $line, $matches)) {
                $this->mask = $matches[1];
                continue;
            }

            // Find the mem addr and value
            preg_match_all('/(\d+)/', $line, $matches);

            $pointer = intval($matches[1][0]);
            $val     = intval($matches[1][1]);

            // Get all of the pointers
            foreach($this->getPointers($pointer) as $pointer) {
                // The value is added to each of the pointers
                $this->mem[$pointer] = $val;
            }
        }

        // The answer is all of the values in memory, summed
        return array_sum(array_values($this->mem));
    }

    private function getPointers($pointer)
    {
        $pointers = [];

        // Split the mask into an array
        $mask    = str_split($this->mask);
        // Get the binary of the address and pad it to the same length as the mask
        $address = str_split(str_pad(decbin($pointer), count($mask), '0', STR_PAD_LEFT));

        $result  = '';

        // Cycle through each character in the mask
        for($i = 0; $i < count($mask); $i++) {
            // Leave the xes
            if($mask[$i] === 'X') {
                $result .= 'X';
                continue;
            }

            // A 1 in the mask must go into the address
            if($mask[$i] === '1') {
                $result .= '1';
                continue;
            }

            // All other values in the address stay for now
            $result .= $address[$i];
        }

        // Get the amount of bits that need to be permutated
        $bit_length = substr_count($result, 'X');

        // Cycle through all of the bits as integer values
        for($i = 0; $i <= intval(str_repeat('1', $bit_length), 2); $i++) {
            $p = '';
            // Move $i into a binary string
            $bits = str_split(str_pad(decbin($i), $bit_length, '0', STR_PAD_LEFT));

            // Loop though each character of the masked address
            foreach(str_split($result) as $char) {
                // If its an x, replace it with the first bit in the bits array
                if($char === 'X') {
                    $p .= array_shift($bits);
                } else {
                    // otherwise it stays the same
                    $p .= $char;
                }
            }

            // add it to the pointers array
            $pointers[] = intval($p, 2);
        }

        return $pointers;
    }
}
