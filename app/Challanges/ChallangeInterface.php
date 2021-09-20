<?php

namespace App\Challanges;

interface ChallangeInterface
{
    public function __construct($input, array $extras);

    public function _setup($input);

    public function handlePart1();

    public function handlePart2();
}
