<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;
use drupol\phpermutations\Generators\Permutations;

class Day15 extends ChallangeBase
{
    private $input;

    private $mem = [];

    public function __construct($input)
    {
        $this->input = array_map('intval',explode(",", $input));
    }

    public function handlePart1()
    {
        return $this->run(2020);
    }

    private function run($until)
    {
        $this->mem = $this->input;

        $tracker = [];

        for($i = 0; $i < count($this->mem); $i ++) {
            $tracker[$this->mem[$i]] = $i;
        }

        for($i = count($this->mem); $i < $until; $i++) {
            $last = $this->mem[count($this->mem) - 1];
            $seen = isset($tracker[$last]);

            if(!$seen) {
                $this->mem[] = 0;
                $tracker[$last] = $i - 1;
                continue;
            }

            $last_index = $tracker[$last];

            $this->mem[] = ($i - $last_index) - 1;

            $tracker[$last] = $i - 1;
        }

        return $this->mem[count($this->mem) - 1];
    }

    public function handlePart2()
    {
        return $this->run(30000000);
    }
}
