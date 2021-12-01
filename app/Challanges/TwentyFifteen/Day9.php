<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day9 extends ChallangeBase
{
    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n",trim($input));
    }

    public function handlePart1()
    {
        $routes = [];

        foreach($this->input as $line) {
            preg_match('/^(\w+) to (\w+) = (\d+)$/', $line, $matches);

            [
                ,
                $first,
                $second,
                $dist
            ] = $matches;

            if(! isset($routes[$first]))
                $routes[$first] = [];

            $routes[$first][$second] = intval($dist);

            if(! isset($routes[$second]))
                $routes[$second] = [];

            $routes[$second][$first] = intval($dist);
        }

        $all = $this->permutations(array_keys($routes));

        $shortest = PHP_INT_MAX;

        foreach($all as $path) {
            $total = 0;
            for($i = 1; $i < count($path); $i++)
                $total += $routes[$path[$i - 1]][$path[$i]];

            if($total < $shortest)
                $shortest = $total;
        }

        return $shortest;
    }

    public function handlePart2()
    {
        $routes = [];

        foreach($this->input as $line) {
            preg_match('/^(\w+) to (\w+) = (\d+)$/', $line, $matches);

            [
                ,
                $first,
                $second,
                $dist
            ] = $matches;

            if(! isset($routes[$first]))
                $routes[$first] = [];

            $routes[$first][$second] = intval($dist);

            if(! isset($routes[$second]))
                $routes[$second] = [];

            $routes[$second][$first] = intval($dist);
        }

        $all = $this->permutations(array_keys($routes));

        $longest = 0;

        foreach($all as $path) {
            $total = 0;

            for($i = 1; $i < count($path); $i++)
                $total += $routes[$path[$i - 1]][$path[$i]];

            if($total > $longest)
                $longest = $total;
        }

        return $longest;
    }

    private function permutations($items, $perms = [],&$ret = []) {
        if (empty($items)) {
            $ret[] = $perms;
        } else {
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                $this->permutations($newitems, $newperms,$ret);
            }
        }
        return $ret;
    }
}
