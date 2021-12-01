<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Challanges\TwentyFifteen\{
    Day1  as TwentyFifteenDay1,
    Day2  as TwentyFifteenDay2,
    Day3  as TwentyFifteenDay3,
    Day4  as TwentyFifteenDay4,
    Day5  as TwentyFifteenDay5,
    Day6  as TwentyFifteenDay6,
    Day7  as TwentyFifteenDay7,
    Day8  as TwentyFifteenDay8,
    Day9  as TwentyFifteenDay9,
    Day10 as TwentyFifteenDay10,
    Day11 as TwentyFifteenDay11,
    Day12 as TwentyFifteenDay12,
    Day13 as TwentyFifteenDay13,
    Day14 as TwentyFifteenDay14,
};

use App\Challanges\TwentyNineteen\{
    Day1 as TwentyNineteenDay1,
    Day2 as TwentyNineteenDay2,
    Day3 as TwentyNineteenDay3,
    Day4 as TwentyNineteenDay4
};

use App\Challanges\TwentyTwenty\{
    Day1 as TwentyTwentyDay1,
    Day2 as TwentyTwentyDay2,
    Day3 as TwentyTwentyDay3,
    Day4 as TwentyTwentyDay4,
    Day5 as TwentyTwentyDay5,
    Day6 as TwentyTwentyDay6,
    Day7 as TwentyTwentyDay7,
    Day8 as TwentyTwentyDay8,
    Day9 as TwentyTwentyDay9,
    Day10 as TwentyTwentyDay10,
    Day11 as TwentyTwentyDay11,
    Day12 as TwentyTwentyDay12,
    Day13 as TwentyTwentyDay13,
    Day14 as TwentyTwentyDay14,
    Day15 as TwentyTwentyDay15,
    Day16 as TwentyTwentyDay16,
    Day17 as TwentyTwentyDay17
};

use App\Challanges\TwentyTwentyOne\{
    Day1 as TwentyTwentyOneDay1,
    Day2 as TwentyTwentyOneDay2,
};

class AOCRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:run {--benchmark} {--quite} {--progress} {--rounds=1} {--part=} {--extra1=} {--extra2=} {year} {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run your AOC in a totally overpowered environment';

    private $classMap = [
        2015 => [
            1  => TwentyFifteenDay1::class,
            2  => TwentyFifteenDay2::class,
            3  => TwentyFifteenDay3::class,
            4  => TwentyFifteenDay4::class,
            5  => TwentyFifteenDay5::class,
            6  => TwentyFifteenDay6::class,
            7  => TwentyFifteenDay7::class,
            8  => TwentyFifteenDay8::class,
            9  => TwentyFifteenDay9::class,
            10 => TwentyFifteenDay10::class,
            11 => TwentyFifteenDay11::class,
            12 => TwentyFifteenDay12::class,
            13 => TwentyFifteenDay13::class,
            14 => TwentyFifteenDay14::class,
        ],
        2019 => [
            1  => TwentyNineteenDay1::class,
            2  => TwentyNineteenDay2::class,
            3  => TwentyNineteenDay3::class,
            4  => TwentyNineteenDay4::class
        ],
        2020 => [
            1  => TwentyTwentyDay1::class,
            2  => TwentyTwentyDay2::class,
            3  => TwentyTwentyDay3::class,
            4  => TwentyTwentyDay4::class,
            5  => TwentyTwentyDay5::class,
            6  => TwentyTwentyDay6::class,
            7  => TwentyTwentyDay7::class,
            8  => TwentyTwentyDay8::class,
            9  => TwentyTwentyDay9::class,
            10 => TwentyTwentyDay10::class,
            11 => TwentyTwentyDay11::class,
            12 => TwentyTwentyDay12::class,
            13 => TwentyTwentyDay13::class,
            14 => TwentyTwentyDay14::class,
            15 => TwentyTwentyDay15::class,
            16 => TwentyTwentyDay16::class,
            17 => TwentyTwentyDay17::class
        ],
        2021 => [
            1  => TwentyTwentyOneDay1::class,
            2  => TwentyTwentyOneDay2::class,
        ]
    ];

    private $year;

    private $day;

    private $part;

    private $extra_1;

    private $extra_2;

    private $benchmark;

    private $progress;

    private $start_time;

    private $rounds;

    private $quite;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->beforeHandle();


        $class = new $this->classMap[$this->year][$this->day](
            $this->input,
            [$this->extra_1, $this->extra_2]
        );

        if($this->progress)
            $class->showProgress = true;

        if($this->benchmark)
            $this->start_time = microtime(TRUE);

        $class->_setup($this->input);

        for($i = 0; $i < $this->rounds; $i++) {

            if(! $this->part || $this->part === 1)
                if(! $this->quite)
                    $this->info("Part 1: " . $class->handlePart1());

            if(! $this->part || $this->part === 2 || $class->mustRunBothChallanges) {
                if($class->mustRunBothChallanges && $this->part === 2)
                    $class->handlePart1();

                if(! $this->quite)
                    $this->info("Part 2: " . $class->handlePart2());
            }
        }

        if($this->benchmark)
            $this->info("Executed in " . number_format(microtime(TRUE) - $this->start_time, 6) . " seconds");

        return 0;
    }

    private function beforeHandle()
    {
        $this->year      = $this->argument('year');
        $this->day       = $this->argument('day');
        $this->part      = (int) $this->option('part');
        $this->rounds    = $this->option('rounds');
        $this->quite     = $this->option('quite');
        $this->benchmark = $this->option('benchmark');
        $this->progress  = $this->option('progress');
        $this->extra_1   = $this->option('extra1');
        $this->extra_2   = $this->option('extra2');

        $this->input = trim(file_get_contents(storage_path("inputs/day_{$this->day}_{$this->year}.txt")));
    }
}
