<?php

namespace App\Challanges\TwentyTwenty;

class Day5
{
    private $input;

    private $total_columns = 127;
    private $total_rows    = 7;
    private $ids           = [];

    public function __construct($input)
    {
        $this->input = explode("\n", trim($input));
    }

    public function handlePart1()
    {
        foreach($this->input as $id) {
            $column_map = range(0, $this->total_columns);
            $row_map    = range(0, $this->total_rows);
            $columns    = str_split(substr($id, 0, 7));
            $rows       = str_split(substr($id, 7));

            foreach($columns as $column)
                $column_map = $column === 'F' ?
                    array_slice($column_map, 0, count($column_map) / 2) :
                    array_slice($column_map, count($column_map) / 2);

            foreach($rows as $row)
                $row_map = $row === 'L' ?
                    array_slice($row_map, 0, count($row_map) / 2) :
                    array_slice($row_map, count($row_map) / 2);

            $this->ids[] = $column_map[0] * 8 + $row_map[0];
        }

        return max($this->ids);
    }

    public function handlePart2()
    {
        sort($this->ids);

        for ($c = 0, $n = 1; $c < count($this->ids); $c++, $n++)
            if($this->ids[$c] + 1 !== $this->ids[$n])
                return $this->ids[$c] + 1;
    }
}
