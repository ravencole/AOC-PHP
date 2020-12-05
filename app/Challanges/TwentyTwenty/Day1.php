<?php

namespace App\Challanges\TwentyTwenty;

class Day1
{
    private $input;

    public function __construct($input)
    {
        $this->input = array_map('intval' ,explode("\n", $input));

        sort($this->input);
    }

    public function handlePart1()
    {
        for($i = 0; $i < count($this->input); $i++)
            for($j = 0; $j < count($this->input); $j++)
                if($this->input[$i] + $this->input[$j] === 2020)
                    return $this->input[$i] * $this->input[$j];
    }

    public function handlePart2()
    {
        for ($i = 0; $i < count($this->input); $i++)
            for ($j = 0; $j < count($this->input); $j++)
                for ($k = 0; $k < count($this->input); $k++)
                    if ($this->input[$i] + $this->input[$j] + $this->input[$k] === 2020)
                        return $this->input[$i] * $this->input[$j] * $this->input[$k];
    }
}
