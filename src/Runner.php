<?php

declare(strict_types=1);

namespace Aoc2022;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Day01\Day01;
use Aoc2022\Day02\Day02;
use Aoc2022\Day03\Day03;

class Runner
{
    /** @var array<int, Runnable> */
    private array $days = [
        1 => Day01::class,
        2 => Day02::class,
        3 => Day03::class,
    ];

    public function start(string $argDay = '', string $argPart = ''): void
    {
        $day = (int)$argDay;
        if ($day === 0) {
            $from = \min(\array_keys($this->days));
            $to = \max(\array_keys($this->days));
            $day = (int)\trim((string)\readline("Select a day to run [{$from}-{$to}]:\nDay: "));
        }

        if (empty($this->days[$day])) {
            echo "This day does not exist\n";

            return;
        }

        $c = new $this->days[$day]();
        if (!$c instanceof Runnable) {
            echo "This day does not implements required contracts\n";

            return;
        }

        $part = (int)$argPart;
        if ($part === 0) {
            $part = \trim((string)\readline("Select part to run [1 or 2]:\nPart: ")) === '2' ? 2 : 1;
        }

        $inputFile = 'src/Day' . \str_pad("{$day}", 2, '0', \STR_PAD_LEFT) . '/input.txt';
        if (!\file_exists($inputFile)) {
            echo "Input file '{$inputFile}' does not exists\n";

            return;
        }

        echo "\nResult of Day {$day} part {$part} is:\n\n  ";
        $start = \microtime(true);
        echo $c->{'part' . $part}(\file_get_contents($inputFile));
        echo "\n\nFinished in " . \round((\microtime(true) - $start) * 1000, 5) . " ms\n";
        echo 'Max memory usage: ' . (\memory_get_peak_usage(true) / 1024 / 1024) . " MB\nGood bye\n";
    }

    public function runPerformanceTest(string $day = ''): void
    {
        $toRun = $this->days;
        $d = (int)$day;
        if ($d > 0) {
            $toRun = [$d => $this->days[$d]];
        }
        echo "           |   Min [ms]   |   Avg [ms]   |   Max [ms]\n";
        foreach ($toRun as $n => $class) {
            $c = new $class();
            $input = \file_get_contents('src/Day' . \str_pad("{$n}", 2, '0', \STR_PAD_LEFT) . '/input.txt');
            \printf(" Day %2d  ------------------------------------------------\n", $n);

            $durations = [];
            for ($i = 0; $i < 5; $i += 1) {
                $start = \microtime(true);
                $c->part1($input);
                $end = \microtime(true);
                $durations[] = \round(($end - $start) * 1000, 4);
            }
            \printf(
                "   Part 1  |%11.4f   |%11.4f   |%11.4f\n",
                \min($durations),
                \array_sum($durations) / 5,
                \max($durations),
            );

            $durations = [];
            for ($i = 0; $i < 5; $i += 1) {
                $start = \microtime(true);
                $c->part2($input);
                $end = \microtime(true);
                $durations[] = \round(($end - $start) * 1000, 4);
            }
            \printf(
                "   Part 2  |%11.4f   |%11.4f   |%11.4f\n",
                \min($durations),
                \array_sum($durations) / 5,
                \max($durations),
            );
        }
    }
}
