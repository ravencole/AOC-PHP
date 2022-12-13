<?php

namespace App\Challanges\TwentyTwentyOne;

use App\Challanges\ChallangeBase;

class Day2 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        $x = 0;
        $z = 0;

        foreach($this->input as $line) {
            [ $dir, $amt ] = explode(' ', $line);

            switch($dir) {
                case 'forward':
                    $x += intval($amt); break;
                case 'down':
                    $z += intval($amt); break;
                case 'up':
                    $z -= intval($amt); break;
            }
        }

        return $x * $z;
    }

    public function handlePart2()
    {
        $x   = 0;
        $z   = 0;
        $aim = 0;

        foreach($this->input as $line) {
            [ $dir, $amt ] = explode(' ', $line);

            switch($dir) {
                case 'forward':
                    $x += intval($amt);
                    $z += $aim * intval($amt);
                    break;
                case 'down':
                    $aim += intval($amt); break;
                case 'up':
                    $aim -= intval($amt); break;
            }
        }

        return $x * $z;
    }
}
