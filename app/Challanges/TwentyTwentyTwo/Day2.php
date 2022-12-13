<?php

namespace App\Challanges\TwentyTwentyTwo;

use App\Challanges\ChallangeBase;

class Day2 extends ChallangeBase
{
    const MY_ROCK    = 'X';
    const MY_PAPER   = 'Y';
    const MY_SCISSOR = 'Z';

    const THEIR_ROCK    = 'A';
    const THEIR_PAPER   = 'B';
    const THEIR_SCISSOR = 'C';

    const SHOULD_LOSE = 'X';
    const SHOULD_DRAW = 'Y';
    const SHOULD_WIN  = 'Z';

    const LOSE = 0;
    const DRAW = 3;
    const WIN  = 6;

    public $input;

    public function _setup($input)
    {
        $this->input = explode("\n", $input);
    }

    public function handlePart1()
    {
        $score = 0;

        foreach($this->input as $line) {
            [ $them, $me ] = explode(' ', $line);

            $score += $this->getScore($this->getOutcome($them, $me), $me);
        }

        return $score;
    }

    public function handlePart2()
    {
        $score = 0;

        foreach($this->input as $line) {
            [ $them, $me ] = explode(' ', $line);

            $choice = $this->getChoice($them, $me);

            $score += $this->getScore($this->getOutcome($them, $choice), $choice);
        }

        return $score;
    }

    private function getOutcome($first, $second): int
    {
        switch($first) {
            case self::THEIR_ROCK:
                switch($second) {
                    case self::MY_ROCK:
                        return self::DRAW;
                    case self::MY_PAPER:
                        return self::WIN;
                    case self::MY_SCISSOR:
                    default:
                        return self::LOSE;
                }
            case self::THEIR_PAPER:
                switch($second) {
                    case self::MY_ROCK:
                        return self::LOSE;
                    case self::MY_PAPER:
                        return self::DRAW;
                    case self::MY_SCISSOR:
                    default:
                        return self::WIN;
                }
            case self::THEIR_SCISSOR:
            default:
                switch($second) {
                    case self::MY_ROCK:
                        return self::WIN;
                    case self::MY_PAPER:
                        return self::LOSE;
                    case self::MY_SCISSOR:
                    default:
                        return self::DRAW;
                }
        }
    }

    private function getChoice($first, $second): string
    {
        switch($first) {
            case self::THEIR_ROCK:
                switch($second) {
                    case self::SHOULD_WIN:
                        return self::MY_PAPER;
                    case self::SHOULD_DRAW:
                        return self::MY_ROCK;
                    case self::SHOULD_LOSE:
                    default:
                        return self::MY_SCISSOR;
                }
            case self::THEIR_PAPER:
                switch($second) {
                    case self::SHOULD_WIN:
                        return self::MY_SCISSOR;
                    case self::SHOULD_DRAW:
                        return self::MY_PAPER;
                    case self::SHOULD_LOSE:
                    default:
                        return self::MY_ROCK;
                }
            case self::THEIR_SCISSOR:
            default:
                switch($second) {
                    case self::SHOULD_WIN:
                        return self::MY_ROCK;
                    case self::SHOULD_DRAW:
                        return self::MY_SCISSOR;
                    case self::SHOULD_LOSE:
                    default:
                        return self::MY_PAPER;
                }
        }
    }

    private function getScore($outcome, $choice): int
    {
        return $outcome + ($choice === self::MY_ROCK
                ? 1
                : ($choice === self::MY_PAPER
                    ? 2
                    : 3
                ));
    }
}
