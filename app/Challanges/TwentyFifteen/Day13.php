<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day13 extends ChallangeBase
{
    public $input = '';

    public $guests = [];

    public function _setup($input)
    {
        $this->input = explode("\n",trim($input));

        foreach($this->input as $line) {
            preg_match('/^(\w+)\swould\s(lose|gain)\s(\d+)\shappiness\sunits\sby\ssitting\snext\sto\s(\w+)/', $line, $matches);

            if(! isset($this->guests[$matches[1]]))
                $this->guests[$matches[1]] = [];

            $this->guests[$matches[1]][$matches[4]] = intval($matches[3]) * ($matches[2] === 'lose' ? -1 : 1);
        }
    }

    public function handlePart1()
    {
        $perms = $this->permute(array_keys($this->guests));

        $highest = 0;

        foreach($perms as $perm) {
            $total = 0;

            for($i = 0; $i < count($perm); $i++) {
                $left  = $i === 0 ? $perm[count($perm) - 1] : $perm[$i - 1];
                $right = $i === count($perm) - 1 ? $perm[0] : $perm[$i + 1];
                $curr  = $perm[$i];

                $total += $this->guests[$curr][$left];
                $total += $this->guests[$curr][$right];
            }

            if($total > $highest)
                $highest = $total;
        }

        return $highest;
    }

    public function handlePart2()
    {
        foreach(array_keys($this->guests) as $guest) {
            if(! isset($this->guests['me']))
                $this->guests['me'] = [];

            $this->guests[$guest]['me'] = 0;
            $this->guests['me'][$guest] = 0;
        }

        return $this->handlePart1();
    }

    private function permute($array) {
        $result = [];

        $recurse = function($array, $start_i = 0) use (&$result, &$recurse) {
            if ($start_i === count($array)-1) {
                array_push($result, $array);
            }

            for ($i = $start_i; $i < count($array); $i++) {
                //Swap array value at $i and $start_i
                $t = $array[$i]; $array[$i] = $array[$start_i]; $array[$start_i] = $t;

                //Recurse
                $recurse($array, $start_i + 1);

                //Restore old order
                $t = $array[$i]; $array[$i] = $array[$start_i]; $array[$start_i] = $t;
            }
        };

        $recurse($array);

        return $result;
    }
}
