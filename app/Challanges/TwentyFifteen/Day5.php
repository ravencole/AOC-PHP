<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day5 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n",trim($input));
    }

    public function handlePart1()
    {
        return array_reduce($this->input, function($a, $line) {
            $VOWELS = ['a','e','i','o','u'];

            $pairs   = 0;
            $vowels  = in_array($line[0], $VOWELS) ? 1 : 0;
            $invalid = false;

            for($i = 1; $i < strlen($line); $i++) {
                $curr = $line[$i];
                $prev = $line[$i - 1];

                if($curr === $prev)
                    $pairs++;

                if(in_array($curr, $VOWELS))
                    $vowels++;

                if(in_array("{$prev}{$curr}", ['ab','cd','pq','xy']))
                    $invalid = true;
            }

            return $vowels >= 3 && $pairs >= 1 && ! $invalid
                ? $a + 1 : $a;
        }, 0);
    }

    public function handlePart2()
    {
        return array_reduce($this->input, function($a, $line) {
            $repeat = preg_match_all('/([a-z][a-z])[a-z]*\1/', $line);
            $zyz    = preg_match_all('/([a-z])([a-z])\1/', $line);

            if($repeat > 0 && $zyz > 0)
                return $a + 1;

            return $a;
        }, 0);
    }
}
