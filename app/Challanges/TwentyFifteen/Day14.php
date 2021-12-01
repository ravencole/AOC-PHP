<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;

class Day14 extends ChallangeBase
{
    public $input = '';

    public $deer = [];

    public function _setup($input)
    {
        $this->input = explode("\n",trim($input));

        foreach($this->input as $line) {
            preg_match('/^(\w+)[^0-9]*(\d+)[^0-9]*(\d+)[^0-9]*(\d+)/', $line, $matches);

            [,$name,$speed,$on,$off] = $matches;

            $this->deer[$name] = [
                'speed'    => intval($speed),
                'on'       => intval($on),
                'off'      => intval($off),
                'position' => 0,
            ];
        }
    }

    public function handlePart1()
    {
        for ($i = 1; $i < 2503; $i++) {
            foreach($this->deer as $deer => $stats) {
                if($i % ($stats['on'] + $stats['off']) < $stats['on'])
                    $this->deer[$deer]['position'] += $stats['speed'];
            }
        }

        dd($this->deer);
    }

    public function handlePart2()
    {
    }
}
