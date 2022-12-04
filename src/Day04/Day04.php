<?php

declare(strict_types=1);

namespace Aoc2022\Day04;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day04 implements Runnable
{
    public function part1(string $input): string
    {
        $res = Parser::getLineElements($input, ',')->map(static function ($r) {
            $elves1 = \explode('-', $r[0]);
            $elves2 = \explode('-', $r[1]);

            return match (true) {
                $elves1[0] >= $elves2[0] && $elves1[1] <= $elves2[1] => true,
                $elves2[0] >= $elves1[0] && $elves2[1] <= $elves1[1] => true,
                default => false,
            };
        })->filter()->count();

        return (string)$res;
    }

    public function part2(string $input): string
    {
        $res = Parser::getLineElements($input, ',')->map(static function ($r) {
            $elves1 = \explode('-', $r[0]);
            $elves2 = \explode('-', $r[1]);

            return match (true) {
                $elves1[0] >= $elves2[0] && $elves1[0] <= $elves2[1] => true,
                $elves1[1] >= $elves2[0] && $elves1[1] <= $elves2[1] => true,
                $elves2[0] >= $elves1[0] && $elves2[0] <= $elves1[1] => true,
                $elves2[1] >= $elves1[0] && $elves2[1] <= $elves1[1] => true,
                default => false,
            };
        })->filter()->count();

        return (string)$res;
    }
}
