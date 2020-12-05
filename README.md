# Advent of Code - PHP

Add your input to `./storage/inputs/` in the format of `day_{day}_{year}.txt`. 
For example: to add the input for day 5 of the 2020 advent of code, create the file
`./storage/inputs/day_5_2020.txt`.

Write you solutions in `app/Challanges/` under the namespace of the year spelled out. For the 2020 AOC
we're using the namespace `App\Challanges\TwentyTwenty`.

Add your class to the classmap in `App\Console\Commands\AOCRun`, then, using day 5 of 2020
again as an example, run `php artisan aoc:run 2020 5`

---

## Command line syntax

All examples use Day 5 of 2020 as the target challange. 

Run your challange:

```bash
php artisan aoc:run 2020 5
```

Run a particular part of a challange:

```bash
php artisan aoc:run 2020 5 2
```

Benchmark a particular part of a challange:

```bash
php artisan aoc:run --benchmark 2020 5 2
```
