<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day12 extends ChallangeBase
{
    private $input;

    private $x = 0;
    private $y = 0;
    private $waypoint_x = 0;
    private $waypoint_y = 0;
    private $current_dir = 'E';

    public function __construct($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        foreach($this->input as $command) {
            preg_match('/^(\w)(\d+)$/', $command, $matches);
            $dir = $matches[1];
            $amt = intval($matches[2]);

            if(in_array($dir, ['N','S','E','W','F'])) {
                $dir = $dir === 'F' ? $this->current_dir : $dir;
                switch ($dir) {
                    case 'E':
                        $this->x += $amt;
                        break;
                    case 'W':
                        $this->x -= $amt;
                        break;
                    case 'N':
                        $this->y += $amt;
                        break;
                    case 'S':
                        $this->y -= $amt;
                        break;
                }
            } else {
                $this->changeDirection($dir, $amt);
            }
        }

        return abs($this->x) + abs($this->y);
    }

    private function changeDirection($dir, $amt)
    {
        $dir_map = [
            'N' => [
                'R' => [
                    90  => 'E',
                    180 => 'S',
                    270 => 'W'
                ],
                'L' => [
                    90  => 'W',
                    180 => 'S',
                    270 => 'E'
                ]
            ],
            'S' => [
                'R' => [
                    90  => 'W',
                    180 => 'N',
                    270 => 'E'
                ],
                'L' => [
                    90  => 'E',
                    180 => 'N',
                    270 => 'W'
                ]
            ],
            'W' => [
                'R' => [
                    90  => 'N',
                    180 => 'E',
                    270 => 'S'
                ],
                'L' => [
                    90  => 'S',
                    180 => 'E',
                    270 => 'N'
                ]
            ],
            'E' => [
                'R' => [
                    90  => 'S',
                    180 => 'W',
                    270 => 'N'
                ],
                'L' => [
                    90  => 'N',
                    180 => 'W',
                    270 => 'S'
                ]
            ]
        ];

        $this->current_dir = $dir_map[$this->current_dir][$dir][$amt];
    }

    public function handlePart2()
    {
        $this->x = 0;
        $this->y = 0;
        $this->waypoint_x = 10;
        $this->waypoint_y = 1;

        foreach($this->input as $command) {
            preg_match('/^(\w)(\d+)$/', $command, $matches);
            $dir = $matches[1];
            $amt = intval($matches[2]);

            if($dir === 'F') {
                $this->x += $this->waypoint_x * $amt;
                $this->y += $this->waypoint_y * $amt;
            } elseif(in_array($dir, ['N', 'S', 'W', 'E'])) {
                if($dir === 'N') {
                    $this->waypoint_y += $amt;
                }
                if($dir === 'S') {
                    $this->waypoint_y -= $amt;
                }
                if($dir === 'E') {
                    $this->waypoint_x += $amt;
                }
                if($dir === 'W') {
                    $this->waypoint_x -= $amt;
                }
            } else {
                $this->rotateWaypoint($dir, $amt);
            }
        }

        return abs($this->x) + abs($this->y);
    }

    private function rotateWaypoint($dir, $amt)
    {
        for ($i = $amt; $i > 0; $i -= 90) {
            if($dir === 'L')
                $this->rotateWaypointLeft90Degrees();
            else
                $this->rotateWaypointRight90Degrees();
        }
    }

    private function rotateWaypointLeft90Degrees()
    {
        if($this->inUpperLeft())
            $this->moveToLowerLeft();
        else if ($this->inUpperRight())
            $this->moveToUpperLeft();
        else if ($this->inLowerRight())
            $this->moveToUpperRight();
        else if ($this->inLowerLeft())
            $this->moveToLowerRight();
    }

    private function rotateWaypointRight90Degrees()
    {
        if($this->inUpperLeft())
            $this->moveToUpperRight();
        else if ($this->inUpperRight())
            $this->moveToLowerRight();
        else if ($this->inLowerRight())
            $this->moveToLowerLeft();
        else if ($this->inLowerLeft())
            $this->moveToUpperLeft();
    }

    private function moveToUpperRight()
    {
        $x = $this->waypoint_x;
        $y = $this->waypoint_y;

        $this->waypoint_x = abs($y);
        $this->waypoint_y = abs($x);
    }

    private function moveToUpperLeft()
    {
        $x = $this->waypoint_x;
        $y = $this->waypoint_y;

        $this->waypoint_x = -1 * abs($y);
        $this->waypoint_y =      abs($x);
    }

    private function moveToLowerRight()
    {
        $x = $this->waypoint_x;
        $y = $this->waypoint_y;

        $this->waypoint_x =      abs($y);
        $this->waypoint_y = -1 * abs($x);
    }

    private function moveToLowerLeft()
    {
        $x = $this->waypoint_x;
        $y = $this->waypoint_y;

        $this->waypoint_x = -1 * abs($y);
        $this->waypoint_y = -1 * abs($x);
    }

    private function inUpperLeft()
    {
        return $this->waypoint_x <= 0 && $this->waypoint_y >= 0;
    }

    private function inUpperRight()
    {
        return $ur = $this->waypoint_x >= 0 && $this->waypoint_y >= 0;
    }

    private function inLowerRight()
    {
        return $this->waypoint_x >= 0 && $this->waypoint_y <= 0;
    }

    private function inLowerLeft()
    {
        return $this->waypoint_x <= 0 && $this->waypoint_y <= 0;
    }
}
