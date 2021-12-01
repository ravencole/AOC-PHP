<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day7 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n",trim($input));
    }

    public function handlePart1()
    {
        $wires = [];

        $queue = $this->input;

        while(! empty($queue)) {
            $line = array_shift($queue);

            if(preg_match('/^(\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if (isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one;
            }
            else if(preg_match('/^NOT (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one ^ 65535;
            }
            else if(preg_match('/^(\d+|\w+) RSHIFT (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one >> $two;
            }
            else if(preg_match('/^(\d+|\w+) LSHIFT (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one << $two;
            }
            else if(preg_match('/^(\d+|\w+) OR (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one | $two;
            }
            else if(preg_match('/^(\d+|\w+) AND (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one & $two;
            }
        }

        return $wires['a'];
    }

    public function handlePart2()
    {
        $wires = [
            'b' => $this->handlePart1()
        ];

        $queue = $this->input;

        while(! empty($queue)) {
            $line = array_shift($queue);

            if(preg_match('/^(\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if (isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one;
            }
            else if(preg_match('/^NOT (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one ^ 65535;
            }
            else if(preg_match('/^(\d+|\w+) RSHIFT (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one >> $two;
            }
            else if(preg_match('/^(\d+|\w+) LSHIFT (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one << $two;
            }
            else if(preg_match('/^(\d+|\w+) OR (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one | $two;
            }
            else if(preg_match('/^(\d+|\w+) AND (\d+|\w+) -> (\w+)$/', $line, $matches)) {
                [ , $one, $two, $dest ] = $matches;

                if($this->isInt($one)) {
                    $one = intval($one);
                }
                else if(isset($wires[$one])) {
                    $one = $wires[$one];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                if($this->isInt($two)) {
                    $two = intval($two);
                }
                else if(isset($wires[$two])) {
                    $two = $wires[$two];
                }
                else {
                    array_push($queue, $line);

                    continue;
                }

                $wires[$dest] = $one & $two;
            }
        }

        return $wires['a'];
    }

    private function isInt($val) {
        return preg_match('/\d+/', $val);
    }
}
