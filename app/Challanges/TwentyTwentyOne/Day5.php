<?php

namespace App\Challanges\TwentyTwentyOne;

use App\Challanges\ChallangeBase;

class Day5 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
//        $this->input = explode("\n", $input);
        $this->input = [
            '0,9 -> 5,9',
            '8,0 -> 0,8',
            '9,4 -> 3,4',
            '2,2 -> 2,1',
            '7,0 -> 7,4',
            '6,4 -> 2,0',
            '0,9 -> 2,9',
            '3,4 -> 1,4',
            '0,0 -> 8,8',
            '5,5 -> 8,2',
        ];
    }

    public function handlePart1()
    {
        $coords = array_reduce($this->input, function($a, $b) {
            preg_match_all('/(\d+)/', $b, $matches);

            $coords = $matches[0];

            if($coords[0] !== $coords[2] && $coords[1] !== $coords[3])
                return $a;

            $a[] = $coords;

            return $a;
        }, []);

        $map = [];

        foreach($coords as $coord) {
             $coord = array_map('intval', $coord);

             $x1 = $x2 = $y1 = $y2 = null;

             if($coord[0] < $coord[2] || $coord[1] < $coord[3]) {
                 $x1 = $coord[0];
                 $y1 = $coord[1];
                 $x2 = $coord[2];
                 $y2 = $coord[3];
             }
             else {
                 $x1 = $coord[2];
                 $y1 = $coord[3];
                 $x2 = $coord[0];
                 $y2 = $coord[1];
             }

             dump([
                 $x1, $y1, $x2, $y2
             ]);

             $vertical = $y1 !== $y2;
             $distance = $vertical
                 ? $y2 - $y1
                 : $x2 - $x1;

             for($i = 0; $i < $distance; $i++) {
                 $x = $vertical ? $x1 : $x1 + $i;
                 $y = $vertical ? $y1 + $i : $y1;

                 if(! isset($map[$y]))
                     $map[$y] = [];

                 if(! isset($map[$y][$x]))
                     $map[$y][$x] = 0;

                 $map[$y][$x]++;
             }
        }

        dd($map);
    }

    public function handlePart2()
    {
    }
}
