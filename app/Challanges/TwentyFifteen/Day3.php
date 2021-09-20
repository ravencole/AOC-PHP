<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;

class Day3 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = str_split(trim($input));
    }

    public function handlePart1()
    {
        return count(array_keys(array_reduce($this->input, function($a, $dir) {
            switch($dir) {
                case '^':
                    $a['y']++;
                    break;
                case 'v':
                    $a['y']--;
                    break;
                case '>':
                    $a['x']++;
                    break;
                case '<':
                    $a['x']--;
                    break;
            }

            $a['houses'][$a['x'] . ':' . $a['y']] = true;

            return $a;
        }, ['x' => 0, 'y' => 0, 'houses' => ['0:0' => true]])['houses']));
    }

    public function handlePart2()
    {
        return count(array_keys(array_reduce($this->input, function($a, $dir) {
            $per = $a['i'] & 1 ? 'r' : 's';

            switch($dir) {
                case '^':
                    $a['coords'][$per]['y']++;
                    break;
                case 'v':
                    $a['coords'][$per]['y']--;
                    break;
                case '>':
                    $a['coords'][$per]['x']++;
                    break;
                case '<':
                    $a['coords'][$per]['x']--;
                    break;
            }

            $x = $a['coords'][$per]['x'];
            $y = $a['coords'][$per]['y'];

            $a['houses']["{$x}:{$y}"] = true;

            $a['i']++;

            return $a;
        }, [
            'i' => 0,
            'coords' => [
                'r' => [
                    'x' => 0,
                    'y' => 0,
                ],
                's' => [
                    'x' => 0,
                    'y' => 0,
                ],
            ],
            'houses' => [
                '0:0'
            ]
        ])['houses']));
    }
}
