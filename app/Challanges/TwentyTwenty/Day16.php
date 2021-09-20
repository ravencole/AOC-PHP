<?php

namespace App\Challanges\TwentyTwenty;

use App\Challanges\ChallangeBase;

class Day16 extends ChallangeBase
{
    public $mustRunBothChallanges = true;

    private $input;

    private $rules = [];

    private $nearby_tickets = [];

    private $valid_tickets = [];

    private $rule_map_rough = [];

    private $rule_map = [];

    private $own_ticket = [];

    public function __construct($input)
    {
        $this->input = preg_split("#\n\s*\n#Uis", trim($input));

        // Sort the rules array
        foreach(explode("\n",$this->input[0]) as $rule) {
            [
                $name, $ranges
            ] = explode(':', $rule);

            // Get all of the numbers in the range
            preg_match_all("/(\d+)/", $ranges, $matches);

            // Add them as tuples to the rules array under the name of the rule
            $this->rules[trim($name)] = array_reduce($matches[0], function($a, $b) {
               if(count($a[count($a) - 1]) > 1)
                   $a[] = [];
               $a[count($a) - 1][] = intval($b);
               return $a;
            }, [[]]);
        }

        // Split all of the nearby tickets into arrays of integers
        $this->nearby_tickets = array_map(function($line) {
           return array_map('intval', explode(',', $line));
        },array_slice(explode("\n", trim($this->input[2])), 1));
    }

    public function handlePart1()
    {
        $invalids = [];

        foreach($this->nearby_tickets as $ticket) {
            // Premptivly add the ticket to the valids array
            $this->valid_tickets[] = $ticket;

            // Foreach value in the ticket
            foreach($ticket as $val) {
                // Run each value against each rule
                foreach(array_values($this->rules) as $rule) {
                    // Until we find a rule that it matches
                    if(
                        ($val >= $rule[0][0] && $val <= $rule[0][1]) ||
                        ($val >= $rule[1][0] && $val <= $rule[1][1])
                    ) {
                        // break out of the ticket loop
                        continue 2;
                    }
                }

                // If we made it here the ticket is invalid

                // Add the value that invalidated the ticket to the invalids array
                $invalids[] = $val;
                // Remove the ticket from the valid tickets array
                array_pop($this->valid_tickets);
            }

            $vcount = count($this->valid_tickets);
            $icount = count($invalids);

            if($this->showProgress) {
                echo "\rValid: {$vcount} / Invalid: {$icount}";
                usleep(20000);
            }
        }

        if($this->showProgress)
            echo "\r                                                          \r";

        // Sum all of the invalid values
        return array_sum($invalids);
    }

    public function handlePart2()
    {
        // Parse the 'own' ticket into an array of integers
        $this->own_ticket = array_map('intval', explode(',',explode("\n", $this->input[1])[1]));

        // Map over all of the rules
        foreach($this->rules as $name => $rule) {
            // Check each column to see if each value passes
            for($col = 0; $col < count($this->valid_tickets[0]); $col++) {
                // Run the rule on the column value
                $column_passes = array_reduce($this->valid_tickets, function($a,$b) use ($col, $rule) {
                   if($a === false)
                       return $a;

                    return ($b[$col] >= $rule[0][0] && $b[$col] <= $rule[0][1]) ||
                        ($b[$col] >= $rule[1][0] && $b[$col] <= $rule[1][1]);
                }, true);

                if($column_passes) {
                    // Add the column number to the possible column values in the rules array
                    if(!isset($this->rule_map_rough[$name]))
                        $this->rule_map_rough[$name] = [];
                    $this->rule_map_rough[$name][] = $col;
                }
            }
        }

        $rule_map = $this->rule_map_rough;

        // Sort the rule map so that the rule with the least amount of matches is at the top
        uksort($this->rule_map_rough, function($a, $b) use ($rule_map) {
            $a = count($rule_map[$a]);
            $b = count($rule_map[$b]);
            return $a > $b;
        });

        // while there are still values in the tmp rule map
        while(count(array_keys($this->rule_map_rough))) {
            // Get the first rule
            $first = array_keys($this->rule_map_rough)[0];

            // At this point it should only have one column in it,
            // And that is the column that matches the rule
            $this->rule_map[$first] = array_shift($this->rule_map_rough[$first]);

            // Unset it from the tmp array
            unset($this->rule_map_rough[$first]);

            $to_remove = $this->rule_map[$first];

            // Remove the column from all of the rules that still remain in the tmp array
            foreach($this->rule_map_rough as $key => $val) {
                $this->rule_map_rough[$key] = array_reduce($val, function($a, $b) use ($to_remove) {
                   if($b !== $to_remove)
                       $a[] = $b;
                   return $a;
                }, []);
            }

            if($this->showProgress)
                $this->printPart2Progress();
        }

        $result = 1;

        // Multiply each column from the own ticket that's name started with 'departure'
        foreach($this->rule_map as $key => $val) {
            if(explode(' ', $key)[0] === 'departure') {
                $result *= $this->own_ticket[$val];
            }
        }

        return $result;
    }

    private function printPart2Progress()
    {
        $blue   = "\e[36m";
        $green  = "\e[32m";
        $yellow = "\e[33m";
        $purple = "\e[35m";
        $reset  = "\e[0m";
        usleep(250000);
        echo "\n-----------------------------------------------\n\n\n";
        system('clear');

        $rule_map = $this->rule_map_rough;
        $message = array_reduce(array_keys($this->rules), function($a, $b) use ($rule_map, $purple, $reset, $yellow) {
            $vals = $rule_map[$b] ?? [];
            array_unshift($vals, $b);
            $a[] = vsprintf("{$yellow}%-20s {$purple}" . str_repeat('%-3d ', count($vals) - 1) . $reset, $vals);
            return $a;
        }, []);

        echo sprintf("{$blue}%-20s %s{$reset}\n", 'Column', 'Possible Indexes');
        echo join("\n", $message);

        echo "\n\n";

        $message = [];

        foreach(array_keys($this->rules) as $name) {
            if(isset($this->rule_map[$name]))
                $message[] = sprintf("{$yellow}%-20s {$green}%-04d{$reset}", $name, $this->own_ticket[$this->rule_map[$name]]);
            else
                $message[] = sprintf("{$yellow}%-20s {$purple}-{$reset}", $name);
        }

        echo sprintf("{$blue}%-20s %s{$reset}\n", 'Column', 'Value');
        echo join("\n", $message);
        echo "\n";
    }
}
