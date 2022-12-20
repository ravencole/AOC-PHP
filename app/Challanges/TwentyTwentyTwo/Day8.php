<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day8 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = array_map(
            fn($line) => array_map('intval', str_split($line)),
            explode("\n", $input)
        );
    }

    public function handlePart1()
    {
        $input = $this->input;

        $max_col = count($input) - 1;
        $max_row = count($input[0]) - 1;

        $count = 0;

        for($i = 0; $i <= $max_row; $i++) {
            for($ii = 0; $ii <= $max_col; $ii++) {
                if($i === 0 || $i === $max_row || $ii === 0 || $ii === $max_col) {
                    $count++;
                    continue;
                }

                $val = $input[$i][$ii];

                $up = array_slice(array_column($input, $ii), 0, $i);

                if(max($up) < $val) {
                    $count++;
                    continue;
                }

                $down = array_slice(array_column($input, $ii), $i + 1);

                if(max($down) < $val) {
                    $count++;
                    continue;
                }

                $left = array_slice($input[$i], 0, $ii);

                if(max($left) < $val) {
                    $count++;
                    continue;
                }

                $right = array_slice($input[$i], $ii + 1);

                if(max($right) < $val) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function handlePart2()
    {
        $max = 0;

        $calc = function($arr, $val) {
            return array_reduce($arr,
                function($a, $b) use ($val) {
                    if(! $a[0]) {
                        return $a;
                    }

                    if($b < $val) {
                        return [
                            true,
                            $a[1] + 1
                        ];
                    }
                    else {
                        return [
                            false,
                            $a[1] + 1
                        ];
                    }
                },
                [true, 0]
            )[1];
        };

        for($i = 1; $i <= count($this->input[0]) - 2; $i++) {
            for($ii = 1; $ii <= count($this->input) - 2; $ii++) {
                $val = $this->input[$i][$ii];

                $up    = $calc(array_reverse(array_slice(array_column($this->input, $ii), 0, $i)), $val);
                $down  = $calc(array_slice(array_column($this->input, $ii), $i + 1), $val);
                $left  = $calc(array_reverse(array_slice($this->input[$i], 0, $ii)), $val);
                $right = $calc(array_slice($this->input[$i], $ii + 1), $val);

                $tmp = $up * $left * $right * $down;

                if($tmp > $max) {
                    $max = $tmp;
                }
            }
        }

        return $max;
    }
}
