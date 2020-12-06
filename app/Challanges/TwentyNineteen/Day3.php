<?php

namespace App\Challanges\TwentyNineteen;

use App\Challanges\ChallangeBase;

class Day3 extends ChallangeBase
{
    private $input;

    private $wire1         = [];
    private $wire2         = [];
    private $intersections = [];

    public function __construct($input)
    {
        $this->input = explode("\n", $input);

        $this->wire1 = $this->plotWire($this->input[0]);
        $this->wire2 = $this->plotWire($this->input[1]);

        $this->intersections = array_intersect($this->wire1, $this->wire2);
    }

    public function handlePart1()
    {
        return array_reduce($this->intersections, function($a, $b) {
           [$x,$y] = array_map('intval',explode(':', $b));
           $distance = abs($x) + abs($y);
           return $distance < $a ? $distance : $a;
        }, PHP_INT_MAX);
    }

    public function handlePart2()
    {
        $wire1 = $this->wire1;
        $wire2 = $this->wire2;

        return array_reduce($this->intersections, function($a, $b) use ($wire1, $wire2) {
           $steps1 = array_search($b, $wire1);
           $steps2 = array_search($b, $wire2);
           $amt    = $steps1 + $steps2 + 2;

           return $amt < $a ? $amt : $a;
        }, PHP_INT_MAX);
    }

    private function plotWire($wire)
    {
        $points = [];

        $x = 0;
        $y = 0;

        foreach(explode(',', $wire) as $point) {
            $dir = substr($point, 0, 1);
            $amt = intval(substr($point, 1));

            for($i = 0; $i < $amt; $i++) {
                switch($dir) {
                    case 'U':
                        $y++; break;
                    case 'D':
                        $y--; break;
                    case 'L':
                        $x--; break;
                    case 'R':
                        $x++; break;
                }

                $points[] = "{$x}:{$y}";
            }
        }

        return $points;
    }
}
