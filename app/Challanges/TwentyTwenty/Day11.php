<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day11 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input      = explode("\n", $input);
        $this->orig_input = $this->input;
//        $this->input = [
//            'L.LL.LL.LL',
//            'LLLLLLL.LL',
//            'L.L.L..L..',
//            'LLLL.LL.LL',
//            'L.LL.LL.LL',
//            'L.LLLLL.LL',
//            '..L.L.....',
//            'LLLLLLLLLL',
//            'L.LLLLLL.L',
//            'L.LLLLL.LL'
//        ];
    }

    public function handlePart1()
    {
        $this->input = array_reduce($this->input, function($a,$b) {
            $a[] = str_split($b);
            return $a;
        }, []);

        $iterations = 0;

        while(true) {
            $new_arrangement = [];
            for($i = 0; $i < count($this->input); $i++) {
                $new_arrangement[] = [];
                for($j = 0; $j < count($this->input[$i]); $j++) {
                    $seat = $this->input[$i][$j];
                    $adjs = [
                        $this->getStatus( $i - 1,$j - 1),
                        $this->getStatus( $i - 1,    $j),
                        $this->getStatus( $i - 1,$j + 1),

                        $this->getStatus( $i, $j - 1),
                        $this->getStatus( $i, $j + 1),

                        $this->getStatus( $i + 1,$j - 1),
                        $this->getStatus( $i + 1,    $j),
                        $this->getStatus( $i + 1,$j + 1)
                    ];

                    if($seat === 'L' && ! in_array('#', $adjs)) {
                        $new_arrangement[$i][$j] = '#';
                        continue;
                    }

                    if($seat === '#') {
                        $occupied = array_reduce($adjs, function($a,$b) {
                           return $b === '#' ? $a + 1 : $a;
                        }, 0);

                        if($occupied >= 4)
                            $new_arrangement[$i][$j] = 'L';
                        else
                            $new_arrangement[$i][$j] = '#';

                        continue;
                    }

                    $new_arrangement[$i][$j] = $seat;
                }
            }

            $old = $this->makeverificationStr($this->input);
            $new = $this->makeverificationStr($new_arrangement);

            if($old === $new) {
                echo "\n";
                return array_reduce(str_split($old), function($a, $b) {
                    return $b === '#' ? ++$a : $a;
                }, 0);
            } else {
                $this->input = $new_arrangement;
            }

            $iterations++;
            echo "\rIterations: {$iterations}";
        }
    }

    private function makeVerificationStr($input) {
        return join('', array_map(function($a) {return join('', $a);}, $input));
    }

    private function getStatus($row, $col) {
        return (
            ($row >= 0 && $row < count($this->input)) &&
            ($col >= 0 && $col < count($this->input[0]))
        ) ? $this->input[$row][$col] : null;
    }

    public function handlePart2()
    {
        $this->input = $this->orig_input;
        $this->input = array_reduce($this->input, function($a,$b) {
            $a[] = str_split($b);
            return $a;
        }, []);

        $iterations = 0;

        while(true) {
            $new_arrangement = [];
            for($i = 0; $i < count($this->input); $i++) {
                $new_arrangement[] = [];
                for($j = 0; $j < count($this->input[$i]); $j++) {
                    $seat = $this->input[$i][$j];
                    $adjs = [
                        $this->getUpLeftStatus( $i, $j),
                        $this->getUpRightStatus( $i, $j),

                        $this->getUpStatus( $i, $j),
                        $this->getDownStatus( $i, $j),

                        $this->getLeftStatus( $i, $j),
                        $this->getRightStatus( $i, $j),

                        $this->getDownLeftStatus( $i, $j),
                        $this->getDownRightStatus( $i, $j)
                    ];

                    if($seat === 'L' && ! in_array('#', $adjs)) {
                        $new_arrangement[$i][$j] = '#';
                        continue;
                    }

                    if($seat === '#') {
                        $occupied = array_reduce($adjs, function($a,$b) {
                            return $b === '#' ? $a + 1 : $a;
                        }, 0);

                        if($occupied >= 5)
                            $new_arrangement[$i][$j] = 'L';
                        else
                            $new_arrangement[$i][$j] = '#';

                        continue;
                    }

                    $new_arrangement[$i][$j] = $seat;
                }
            }

            $old = $this->makeverificationStr($this->input);
            $new = $this->makeverificationStr($new_arrangement);

            if($old === $new) {
                echo "\n";
                return array_reduce(str_split($old), function($a, $b) {
                    return $b === '#' ? ++$a : $a;
                }, 0);
            } else {
                $this->input = $new_arrangement;
            }

            $iterations++;
            echo "\rIterations: {$iterations}";
        }
    }

    private function getUpLeftStatus($row, $column)
    {
        $row++;
        $column--;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getUpLeftStatus($row, $column);
    }

    private function getUpRightStatus($row, $column)
    {
        $row++;
        $column++;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getUpRightStatus($row, $column);
    }

    private function getDownRightStatus($row, $column)
    {
        $row--;
        $column++;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getDownRightStatus($row, $column);
    }

    private function getDownLeftStatus($row, $column)
    {
        $row--;
        $column--;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getDownLeftStatus($row, $column);
    }

    private function getDownStatus($row, $column)
    {
        $row--;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getDownStatus($row, $column);
    }

    private function getUpStatus($row, $column)
    {
        $row++;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getUpStatus($row, $column);
    }

    private function getRightStatus($row, $column)
    {
        $column++;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getRightStatus($row, $column);
    }

    private function getLeftStatus($row, $column)
    {
        $column--;

        if(
            ($row    < 0 || $row    >= count($this->input)) ||
            ($column < 0 || $column >= count($this->input[0]))
        )
            return null;

        if(in_array($this->input[$row][$column], ['#', 'L']))
            return $this->input[$row][$column];

        return $this->getLeftStatus($row, $column);
    }
}
