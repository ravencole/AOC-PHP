<?php

namespace App\Challanges\TwentyTwentyOne;

use App\Challanges\ChallangeBase;

class Day4 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        $input = $this->input;
        $sequence = array_map('intval',explode(',',array_shift($input)));

        $boards = [[]];

        while(! empty($input)) {
            $line = array_shift($input);

            if(empty($line))
                continue;

            $i = count($boards) - 1;

            if(count($boards[$i]) === 5) {
                array_push($boards, []);
                $i++;
            }

            preg_match_all('/(\d+)/', $line, $matches);

            array_push($boards[$i], array_map('intval',$matches[0]));
        }

        $winner = null;
        $pick   = null;

        while(! empty($sequence)) {
            $pick = array_shift($sequence);

            for($i = 0; $i < count($boards); $i++) {
                for($ii = 0; $ii < count($boards[$i]); $ii++) {
                    for($iii = 0; $iii < count($boards[$i][$ii]); $iii++) {
                        $curr = $boards[$i][$ii][$iii];

                        if($curr === $pick)
                            $boards[$i][$ii][$iii] = '*';
                    }
                }

                for($ii = 0; $ii < count($boards[$i]); $ii++) {
                    $horiz = count(array_unique($boards[$i][$ii])) === 1;
                    $vert  = count(array_unique(array_column($boards[$i], $ii))) === 1;

                    if($horiz || $vert) {
                        $winner = $boards[$i];

                        break 3;
                    }
                }
            }
        }

        return array_reduce($winner, function($a, $b) {
            return $a + array_reduce($b, function($c, $d) {
                return $d === '*' ? $c : $c + $d;
            }, 0);
        }, 0) * $pick;
    }

    public function handlePart2()
    {
        $input = $this->input;
        $sequence = array_map('intval',explode(',',array_shift($input)));

        $boards = [[]];

        while(! empty($input)) {
            $line = array_shift($input);

            if(empty($line))
                continue;

            $i = count($boards) - 1;

            if(count($boards[$i]) === 5) {
                array_push($boards, []);
                $i++;
            }

            preg_match_all('/(\d+)/', $line, $matches);

            array_push($boards[$i], array_map('intval',$matches[0]));
        }

        $winner = null;
        $pick   = null;

        while(true) {
            $pick = array_shift($sequence);

            for($i = 0; $i < count($boards); $i++) {
                for($ii = 0; $ii < count($boards[$i]); $ii++) {
                    for($iii = 0; $iii < count($boards[$i][$ii]); $iii++) {
                        $curr = $boards[$i][$ii][$iii];

                        if($curr === $pick)
                            $boards[$i][$ii][$iii] = '*';
                    }
                }
            }

            $remove = [];

            for ($i = 0; $i < count($boards); $i++) {
                for($ii = 0; $ii < count($boards[$i]); $ii++) {
                    $horiz = count(array_unique($boards[$i][$ii])) === 1;
                    $vert  = count(array_unique(array_column($boards[$i], $ii))) === 1;

                    if($horiz || $vert)
                        $remove[] = $i;
                }
            }

            if(count($boards) === 1 && count($remove) === 1) {
                $winner = $boards[0];
                break;
            }

            foreach($remove as $i)
                unset($boards[$i]);

            $boards = array_values($boards);
        }

        return array_reduce($winner, function($a, $b) {
            return $a + array_reduce($b, function($c, $d) {
                return $d === '*' ? $c : $c + $d;
            }, 0);
        }, 0) * $pick;
    }
}
