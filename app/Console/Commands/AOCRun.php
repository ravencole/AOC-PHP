<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Challanges\TwentyTwenty\{
    Day1 as TwentyTwentyDay1,
    Day2 as TwentyTwentyDay2,
    Day3 as TwentyTwentyDay3,
    Day4 as TwentyTwentyDay4,
    Day5 as TwentyTwentyDay5
};

class AOCRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:run {--benchmark} {year} {day} {part?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $classMap = [
        2020 => [
            1 => TwentyTwentyDay1::class,
            2 => TwentyTwentyDay2::class,
            3 => TwentyTwentyDay3::class,
            4 => TwentyTwentyDay4::class,
            5 => TwentyTwentyDay5::class
        ]
    ];

    private $year;

    private $day;

    private $part;

    private $benchmark;

    private $start_time;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->beforeHandle();

        $class = new $this->classMap[$this->year][$this->day]($this->input);

        if($this->benchmark)
            $this->start_time = microtime(TRUE);

        if(! $this->part || $this->part === 1)
            $this->info("Part 1: " . $class->handlePart1());

        if(! $this->part || $this->part === 2)
            $this->info("Part 2: " . $class->handlePart2());

        if($this->benchmark) {
            $end_time = microtime(TRUE);
            $this->info("Executed in " . number_format($end_time - $this->start_time, 6) . " seconds");
        }

        return 0;
    }

    private function beforeHandle()
    {
        $this->year       = $this->argument('year');
        $this->day        = $this->argument('day');
        $this->part       = (int) $this->argument('part');
        $this->benchmark  = $this->option('benchmark');

        $this->input = trim(file_get_contents(storage_path("inputs/day_{$this->day}_{$this->year}.txt")));
    }
}
