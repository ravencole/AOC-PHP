<?php

namespace App\Challanges;

abstract class ChallangeBase implements ChallangeInterface
{
    public $mustRunBothChallanges = false;

    public $showProgress = false;

    public $extras = [];

    public $input;

    public function __construct($input, array $extras)
    {
        $this->input  = $input;
        $this->extras = $extras;
    }
}
