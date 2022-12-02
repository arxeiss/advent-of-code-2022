<?php

declare(strict_types=1);

namespace Aoc2022\Day01;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day01 implements Runnable
{
    public function part1(string $input): string
    {
        $maxCalories = Parser::getElements($input, "\n\n")
            ->map(static fn ($el) => Parser::getIntLines($el)->sum())
            ->max();

        return (string)$maxCalories;
    }

    public function part2(string $input): string
    {
        $top3Calories = Parser::getElements($input, "\n\n")
            ->map(static fn ($el) => Parser::getIntLines($el)->sum())
            ->sort()
            ->reverse()
            ->slice(0, 3)
            ->sum();

        return (string)$top3Calories;
    }
}
