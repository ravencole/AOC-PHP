<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day4 extends ChallangeBase
{
    private $input;

    public function __construct($input)
    {
        $this->input = preg_split("#\n\s*\n#Uis", trim($input));
    }

    public function handlePart1()
    {
        $valids = 0;

        foreach($this->input as $passport) {
            $fields = array_reduce(preg_split("/(\n|\s+)/Uis", $passport), function($a, $b) {
                $a[] = explode(':', $b)[0];
                return $a;
            }, []);

           if(empty(array_diff(['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'], $fields)))
               $valids++;
        }

        return $valids;
    }

    public function handlePart2()
    {
        $valids = 0;

        foreach($this->input as $passport) {
            $fields = array_reduce(preg_split("/(\n|\s+)/Uis", $passport), function($a, $b) {
                [$key, $value] = explode(':', $b);
                $a[$key] = $value;
                return $a;
            }, []);

            if(empty(array_diff(['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'], array_keys($fields)))) {
                if(intval($fields['byr']) < 1920 || intval($fields['byr']) > 2002)
                    continue;

                if(intval($fields['iyr']) < 2010 || intval($fields['iyr']) > 2020)
                    continue;

                if(intval($fields['eyr']) < 2020 || intval($fields['eyr']) > 2030)
                    continue;

                if(! preg_match('/^#[0-9a-f]{6}$/', $fields['hcl']))
                    continue;

                if(! preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $fields['ecl']))
                    continue;

                if(! preg_match('/^[0-9]{9}$/', $fields['pid']))
                    continue;

                preg_match('/^(\d+)(\w+)$/', $fields['hgt'], $matches);

                $height = intval($matches[1]);
                $std    = $matches[2];

                if(! in_array($std, ['cm', 'in']))
                    continue;

                if($std === 'cm' && ($height < 150 || $height > 193))
                    continue;

                if($std === 'in' && ($height < 59 || $height > 76))
                    continue;

                $valids++;
            }
        }

        return $valids;
    }
}
