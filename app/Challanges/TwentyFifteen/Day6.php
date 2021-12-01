<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day6 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", trim($input));
    }

    public function handlePart1()
    {
        $lights = array_fill(0, 1000, array_fill(0, 1000, false));

        foreach($this->input as $line) {
            preg_match('/^(toggle|turn on|turn off)\s(\d+),(\d+)\sthrough\s(\d+),(\d+)$/', $line, $matches);

            [,$command,$st_x,$st_y,$en_x,$en_y] = $matches;

            for($i = $st_x; $i <= $en_x; $i++) {
                for($ii = $st_y; $ii <= $en_y; $ii++) {
                    switch($command) {
                        case 'turn on':
                            $lights[$i][$ii] = true;
                            break;
                        case 'turn off':
                            $lights[$i][$ii] = false;
                            break;
                        case 'toggle':
                            $lights[$i][$ii] = ! $lights[$i][$ii];
                            break;
                    }
                }
            }
        }

        return array_reduce($lights, function($a, $b) {
            return array_reduce($b, function($c, $d) {
                return $d ? $c + 1 : $c;
            }, 0) + $a;
        }, 0);
    }

    public function handlePart2()
    {
        $lights = array_fill(0, 1000, array_fill(0, 1000, 0));

        foreach($this->input as $line) {
            preg_match('/^(toggle|turn on|turn off)\s(\d+),(\d+)\sthrough\s(\d+),(\d+)$/', $line, $matches);

            [,$command,$st_x,$st_y,$en_x,$en_y] = $matches;

            for($i = $st_x; $i <= $en_x; $i++)
                for($ii = $st_y; $ii <= $en_y; $ii++)
                    switch($command) {
                        case 'turn on':
                            $lights[$i][$ii]++;
                            break;
                        case 'turn off':
                            $lights[$i][$ii]--;
                            if($lights[$i][$ii] < 0)
                                $lights[$i][$ii] = 0;
                            break;
                        case 'toggle':
                            $lights[$i][$ii] += 2;
                            break;
                    }
        }

        return array_reduce($lights, function($a, $b) {
            return array_reduce($b, function($c, $d) {
                return $c + $d;
            }, 0) + $a;
        }, 0);
    }
}
