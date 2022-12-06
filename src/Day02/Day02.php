<?php

declare(strict_types=1);

namespace Aoc2022\Day02;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day02 implements Runnable
{
    // A, X - Rock - 1
    // B, Y - Paper - 2
    // C, Z - Scissors - 3

    /** @var array<string, int> */
    private static array $points = ['X' => 1, 'Y' => 2, 'Z' => 3];

    /** phpcs:disable Squiz.Arrays.ArrayDeclaration.IndexNoNewline */
    private static array $result = [
        'AX' => 3, 'AY' => 6, 'AZ' => 0,
        'BX' => 0, 'BY' => 3, 'BZ' => 6,
        'CX' => 6, 'CY' => 0, 'CZ' => 3,
    ];

    /** phpcs:disable Squiz.Arrays.ArrayDeclaration.IndexNoNewline */
    private static array $toPlay = [
        'AX' => 'Z', 'AY' => 'X', 'AZ' => 'Y',
        'BX' => 'X', 'BY' => 'Y', 'BZ' => 'Z',
        'CX' => 'Y', 'CY' => 'Z', 'CZ' => 'X',
    ];

    public function part1(string $input): string
    {
        $totalPoints = Parser::getLineElements($input)
            ->map(static fn ($l) => self::$points[$l[1]] + self::$result[$l[0] . $l[1]])
            ->sum();

        return (string)$totalPoints;
    }

    public function part2(string $input): string
    {
        $totalPoints = Parser::getLineElements($input)->map(static function ($l) {
            $myTurn = self::$toPlay[$l[0] . $l[1]];

            return self::$points[$myTurn] + self::$result[$l[0] . $myTurn];
        })->sum();

        return (string)$totalPoints;
    }
}
