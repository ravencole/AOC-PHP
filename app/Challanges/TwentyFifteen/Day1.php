<?php

namespace App\Challanges\TwentyFifteen;

use Illuminate\Support\Arr;

use App\Challanges\ChallangeBase;

class Day1 extends ChallangeBase
{
    const REDUCER = 'reducer';
    const FOR     = 'for';

    public $input;

    private $part1Strategy = self::REDUCER;

    public function _setup($input)
    {
        $this->input = $input;

        if($extra_1 = Arr::get($this->extras, '0'))
            $this->part1Strategy = $extra_1;
    }

    public function handlePart1()
    {
        if($this->part1Strategy === self::REDUCER)
            return $this->part1ReducerSolution();
        else if($this->part1Strategy === self::FOR)
            return $this->part1ForSolution();
    }

    public function handlePart2()
    {
        return array_reduce(str_split(trim($this->input)), function($a, $b) {
            if($a['floor'] < 0)
                return $a;

            if($b === '(')
                $a['floor']++;
            else
                $a['floor']--;

            $a['i']++;

            return $a;
        }, ['i' => 0, 'floor' => 0])['i'];
    }

    public function part1ForSolution()
    {
        $input = str_split(trim($this->input));
        $floor = 0;

        for ($i = 0; $i < count($input); $i++) {
            $char = $input[$i];

            if($char === '(')
                $floor++;
            else
                $floor--;
        }

        return $floor;
    }

    private function part1ReducerSolution()
    {
        return array_reduce(str_split(trim($this->input)), function($a, $b) {
            if($b === '(')
                return $a + 1;
            return $a - 1;
        }, 0);
    }
}
