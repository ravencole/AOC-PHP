<?php

namespace App\Challanges\TwentyFifteen;

use App\Challanges\ChallangeBase;
use Illuminate\Support\Arr;

class Day11 extends ChallangeBase
{
    public $input = '';

    public $password = '';

    public function _setup($input)
    {
        $this->input    = trim($input);
        $this->password = $this->input;
    }

    public function handlePart1()
    {
        while(true) {
            $flip_next = true;

            for($i = strlen($this->password) - 1; $i >= 0; $i--) {
                if($flip_next) {
                    $this->password[$i] = chr(ord($this->password[$i]) + 1);

                    if(ord($this->password[$i]) > 122) {
                        $this->password[$i] = 'a';

                        $flip_next = true;
                    } else {
                        $flip_next = false;
                    }
                }
            }

            $inline = '';
            $double = '';
            $inline_found = false;
            $double_found = 0;
            for ($i = 0; $i <= strlen($this->password) - 1; $i++) {
                if(strlen($inline) < 3) {
                    $inline .= $this->password[$i];
                } else {
                    if(
                        ord($inline[0]) + 1 === ord($inline[1])
                        && ord($inline[1]) + 1 === ord($inline[2])
                    ) {
                        $inline_found = true;
                    }
                    else {
                        $inline = $inline[1] . $inline[2] . $this->password[$i];
                    }
                }

                if(strlen($double) === 0 || strlen($double) === 1) {
                    $double .= $this->password[$i];
                } else {
                    $double = $double[1] . $this->password[$i];
                }

                if(strlen($double) === 2) {
                    if($double[0] === $double[1]) {
                        $double_found++;
                        $double = '';
                    }
                }
            }

            if(
                $inline_found
                && $double_found >= 2
                && ! preg_match('/[iol]/', $this->password)
            )
                return $this->password;
        }
    }

    public function handlePart2()
    {
        $this->password = $this->handlePart1();

        return $this->handlePart1();
    }
}
