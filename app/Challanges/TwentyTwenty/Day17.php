<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day17 extends ChallangeBase
{
    private $input;

    private $grid = [];

    private $tmpGrid = [];

    private $lowestGridIndexZ  = 0;
    private $highestGridIndexZ = 0;

    private $lowestGridIndexY  = 0;
    private $highestGridIndexY = 0;

    private $lowestGridIndexX  = 0;
    private $highestGridIndexX = 0;

    public function __construct($input)
    {
        $input = <<<EOT
.#.
..#
###
EOT;
        $this->input = array_map(function($a) {return str_split($a);},explode("\n", $input));

        $this->grid[]    = $this->input;
    }

    public function handlePart1()
    {
        $this->tmpGrid = $this->grid;
        $this->setIndexes();

        for($z = $this->lowestGridIndexZ; $z < $this->highestGridIndexZ; $z++) {
            for($y = $this->lowestGridIndexY; $y < $this->highestGridIndexY; $y++) {
                for($x = $this->lowestGridIndexX; $x < $this->highestGridIndexX; $x++) {
                    $statuses = [
                        $this->getStatus($z - 1, $y - 1, $x - 1),
                        $this->getStatus($z - 1, $y - 1, $x    ),
                        $this->getStatus($z - 1, $y - 1, $x + 1),

                        $this->getStatus($z - 1, $y, $x - 1),
                        $this->getStatus($z - 1, $y, $x    ),
                        $this->getStatus($z - 1, $y, $x + 1),

                        $this->getStatus($z - 1, $y + 1, $x - 1),
                        $this->getStatus($z - 1, $y + 1, $x    ),
                        $this->getStatus($z - 1, $y + 1, $x + 1),

                        $this->getStatus($z, $y - 1, $x - 1),
                        $this->getStatus($z, $y - 1, $x    ),
                        $this->getStatus($z, $y - 1, $x + 1),

                        $this->getStatus($z, $y, $x - 1),
                        $this->getStatus($z, $y, $x    ),
                        $this->getStatus($z, $y, $x + 1),

                        $this->getStatus($z, $y + 1, $x - 1),
                        $this->getStatus($z, $y + 1, $x    ),
                        $this->getStatus($z, $y + 1, $x + 1),

                        $this->getStatus($z + 1, $y - 1, $x - 1),
                        $this->getStatus($z + 1, $y - 1, $x    ),
                        $this->getStatus($z + 1, $y - 1, $x + 1),

                        $this->getStatus($z + 1, $y, $x - 1),
                        $this->getStatus($z + 1, $y, $x    ),
                        $this->getStatus($z + 1, $y, $x + 1),

                        $this->getStatus($z + 1, $y + 1, $x - 1),
                        $this->getStatus($z + 1, $y + 1, $x    ),
                        $this->getStatus($z + 1, $y + 1, $x + 1)
                    ];

                    dd($statuses);
                }
            }
        }
    }

    private function getStatus($z, $y, $x)
    {
        if($z < $this->lowestGridIndexZ)
            $this->tmpGrid[$z] = $this->getZStartingGrid();

        if($z > $this->highestGridIndexZ)
            $this->tmpGrid[$z] = $this->getZStartingGrid();
    }

    private function setIndexes()
    {
        $this->lowestGridIndexZ  = min(array_keys($this->grid));
        $this->highestGridIndexZ = max(array_keys($this->grid));

        $this->lowestGridIndexY  = min(array_keys($this->grid[0]));
        $this->highestGridIndexY = max(array_keys($this->grid[0]));

        $this->lowestGridIndexX  = min(array_keys($this->grid[0][0]));
        $this->highestGridIndexX = max(array_keys($this->grid[0][0]));
    }

    private function getZStartingGrid()
    {
        return array_fill(0, count($this->tmpGrid[0]), $this->getYStartingGrid());
    }

    private function getYStartingGrid()
    {
        return array_fill(0, count($this->tmpGrid[0][0]), $this->getXStartingGrid());
    }

    private function getXStartingGrid()
    {
        return array_fill(0, count($this->tmpGrid[0][0][0]), '.');
    }

    public function handlePart2()
    {
    }
}
