<?php

namespace App\Challanges\TwentyTwentyOne;

use App\Challanges\ChallangeBase;

class Day3 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
//        $this->input = explode("\n", $input);
        $this->input = [
            '00100',
            '11110',
            '10110',
            '10111',
            '10101',
            '01111',
            '00111',
            '11100',
            '10000',
            '11001',
            '00010',
            '01010',
        ];
    }

    public function handlePart1()
    {
        $bits = [];

        foreach($this->input as $line) {
            $split = str_split($line);

            for($i = 0; $i < count($split); $i++) {
                if(! isset($bits[$i]))
                    $bits[] = [
                        0 => 0,
                        1 => 0
                    ];

                $bit = $split[$i];

                if($bit === '0')
                    $bits[$i][0]++;
                else
                    $bits[$i][1]++;
            }
        }

        [$gamma, $epsilon] = array_reduce($bits, function($a, $b) {
            $high = $b[0] > $b[1] ? '0' : '1';
            $low  = $high === '0' ? '1' : '0';

            $a[0] .= $high;
            $a[1] .= $low;

            return $a;
        }, ['', '']);

        return bindec($gamma) * bindec($epsilon);
    }

    public function handlePart2()
    {
        $nums = $this->input;

        $bits = [];

        foreach($this->input as $line) {
            $split = str_split($line);

            for($i = 0; $i < count($split); $i++) {
                if(! isset($bits[$i]))
                    $bits[] = [
                        0 => 0,
                        1 => 0
                    ];

                $bit = $split[$i];

                if($bit === '0')
                    $bits[$i][0]++;
                else
                    $bits[$i][1]++;
            }
        }

        $pos = 0;

        while(count($nums) > 1) {
            $curr = $bits[$pos];

            $high = $curr[0] < $curr[1] ? '0' : '1';

            $nums = array_reduce($nums, function($a, $b) use ($high, $pos) {
                if($b[$pos] === $high)
                    $a[] = $b;
                return $a;
            }, []);

            dump($nums);
            dump($pos);
            dump($curr);
            dump($high);
            dump('----------------------------');

            $pos++;
        }

        $c02 = $nums[0];
        $other = join(array_map(function($a) {
            return $a === '0' ? '1' : '0';
        }, str_split($c02)));

        return bindec($c02) * bindec($other);
    }
}
