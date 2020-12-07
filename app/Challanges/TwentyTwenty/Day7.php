<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day7 extends ChallangeBase
{
    private $input;

    private $bags = [];

    public function __construct($input)
    {
        $this->input = explode("\n", $input);

        foreach($this->input as $line) {
            preg_match('/^(\w+\s\w+)/', $line, $matches);
            $current_color = $matches[1];
            $bag_contents = explode(',', explode('contain', $line)[1]);

            if(! array_key_exists($current_color, $this->bags))
                $this->bags[$current_color] = [];


            foreach($bag_contents as $bag) {
                if(! preg_match('/^(\d+)\s(\w+\s\w+)/', trim($bag), $matches))
                    continue;

                $this->bags[$current_color][$matches[2]] = intval($matches[1]);
            }
        }

    }

    public function handlePart1()
    {
        $bags_to_search = $this->getAllBagsWithColor('shiny gold', $this->bags);
        $searched = [];
        $count    = 0;

        while(! empty($bags_to_search)) {
            $bag = array_shift($bags_to_search);
            if(in_array($bag, $searched))
                continue;
            $contents = $this->getAllBagsWithColor($bag, $this->bags);
            $bags_to_search = array_unique(array_merge($bags_to_search, $contents));
            $searched[] = $bag;
            $count++;
        }

        return $count;
    }

    public function handlePart2()
    {
        $to_search = [];
        $count = 0;

        foreach($this->bags['shiny gold'] as $key => $val) {
            $to_search = array_merge($to_search, array_fill(0, $val, $key));
        }

        while(! empty($to_search)) {
            $color = array_shift($to_search);

            foreach($this->bags[$color] as $key => $val) {
                $to_search = array_merge($to_search, array_fill(0, $val, $key));
            }

            $count++;
        }

        return $count;
    }

    private function getAllBagsWithColor($color, $bags)
    {
        $has_color = [];

        foreach($bags as $bag => $contents) {
            if(in_array($color, array_keys($contents)))
                $has_color[] = $bag;
        }

        return $has_color;
    }
}
